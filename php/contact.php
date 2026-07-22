<?php
/**
 * VUG — Contact form handler
 * Server-side validacija + HTML email + JSON response za AJAX.
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

// ====== KONFIGURACIJA ======
// Promenite ovu adresu na vasu pravu email adresu primaoca
$TO_EMAIL    = 'office@vugagency.com';
$FROM_NAME   = 'VUG Website';
// "From" mora biti sa vaseg domena da bi prosao SPF/DKIM
$FROM_EMAIL  = 'no-reply@vugagency.com';

// ====== reCAPTCHA v3 ======
// Tajni "secret key" sa https://www.google.com/recaptcha/admin (reCAPTCHA v3).
// Site key (javni) je u index.php. Ostavi prazno da iskljucis proveru (lokal).
$RECAPTCHA_SECRET    = '6Lfp810tAAAAAOtLuX8L5qSl_lhp71FRiEsPew20';
// Minimalni skor (0.0 = sigurno bot, 1.0 = sigurno covek). Preporuka: 0.5.
$RECAPTCHA_MIN_SCORE = 0.5;
// Mora da se poklopi sa data-recaptcha-action u index.php / grecaptcha.execute.
$RECAPTCHA_ACTION    = 'contact';

// ====== POMOCNE FUNKCIJE ======
function respond(array $data, int $status = 200): void {
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function clean(string $s): string {
    $s = trim($s);
    $s = str_replace(["\r\n", "\r"], "\n", $s);
    return $s;
}

function safe(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Verifikuje reCAPTCHA v3 token kod Googlea.
 * Vraca dekodovan odgovor (array) ili null ako poziv ka Googlu ne uspe.
 */
function verify_recaptcha(string $secret, string $token, string $remoteIp): ?array {
    $postData = http_build_query([
        'secret'   => $secret,
        'response' => $token,
        'remoteip' => $remoteIp,
    ]);
    $url = 'https://www.google.com/recaptcha/api/siteverify';

    // Primarno cURL (najpouzdanije na WAMP/Apache).
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $postData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        $raw = curl_exec($ch);
        curl_close($ch);
        if ($raw !== false) {
            $data = json_decode((string)$raw, true);
            return is_array($data) ? $data : null;
        }
    }

    // Fallback: file_get_contents (ako je allow_url_fopen ukljucen).
    if (ini_get('allow_url_fopen')) {
        $ctx = stream_context_create(['http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $postData,
            'timeout' => 10,
        ]]);
        $raw = @file_get_contents($url, false, $ctx);
        if ($raw !== false) {
            $data = json_decode((string)$raw, true);
            return is_array($data) ? $data : null;
        }
    }

    return null;
}

// ====== METOD CHECK ======
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['ok' => false, 'message' => 'Method not allowed'], 405);
}

// ====== JEZIK & PORUKE ======
$lang = isset($_POST['lang']) && $_POST['lang'] === 'en' ? 'en' : 'sr';
$t = require __DIR__ . '/../lang/' . $lang . '.php';

// ====== HONEYPOT ======
// Ako bot popuni skriveno polje "website", pretvaramo se da je sve u redu.
if (!empty($_POST['website'] ?? '')) {
    respond(['ok' => true, 'message' => $t['form_success']]);
}

// ====== reCAPTCHA v3 ======
// Aktivno samo ako je secret podesen. Proveravamo pre validacije/slanja da
// botovi ne trose resurse. Odbijamo ako: nema tokena, Google kaze da nije
// uspeo, akcija se ne poklapa, ili je skor ispod praga.
if ($RECAPTCHA_SECRET !== '') {
    $token   = (string)($_POST['recaptcha_token'] ?? '');
    $captcha = $token !== ''
        ? verify_recaptcha($RECAPTCHA_SECRET, $token, $_SERVER['REMOTE_ADDR'] ?? '')
        : null;

    $ok = is_array($captcha)
        && !empty($captcha['success'])
        && (($captcha['score'] ?? 0) >= $RECAPTCHA_MIN_SCORE)
        && (!isset($captcha['action']) || $captcha['action'] === $RECAPTCHA_ACTION);

    if (!$ok) {
        error_log('[VUG] reCAPTCHA odbijena: ' . json_encode($captcha, JSON_UNESCAPED_UNICODE));
        respond([
            'ok' => false,
            'message' => $t['form_err_recaptcha']
        ], 429);
    }
}

// ====== ULAZ ======
$name    = clean((string)($_POST['name']    ?? ''));
$email   = clean((string)($_POST['email']   ?? ''));
$subject = clean((string)($_POST['subject'] ?? ''));
$message = clean((string)($_POST['message'] ?? ''));

// ====== VALIDACIJA ======
$errors = [];

if (mb_strlen($name) < 2 || mb_strlen($name) > 80) {
    $errors['name'] = 'err_name';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) {
    $errors['email'] = 'err_email';
}
if (mb_strlen($subject) < 3 || mb_strlen($subject) > 120) {
    $errors['subject'] = 'err_subject';
}
if (mb_strlen($message) < 3) {
    $errors['message'] = 'err_message';
} elseif (mb_strlen($message) > 3000) {
    $errors['message'] = 'err_message_max';
}

// dodatna zastita od header injection
foreach (['name', 'email', 'subject'] as $k) {
    if (preg_match("/[\r\n]/", $$k)) {
        $errors[$k] = 'err_' . $k;
    }
}

if (!empty($errors)) {
    respond([
        'ok' => false,
        'message' => $t['form_error'],
        'errors' => $errors
    ], 422);
}

// ====== HTML EMAIL TEMPLATE ======
$ip       = $_SERVER['REMOTE_ADDR'] ?? '—';
$ua       = $_SERVER['HTTP_USER_AGENT'] ?? '—';
$dateStr  = date('d.m.Y. H:i');
$siteHost = $_SERVER['HTTP_HOST'] ?? 'vugagency.com';

// Napomena: mejl klijenti (Gmail/Outlook/Apple Mail) brišu <svg> i često ne
// podržavaju CSS gradijente, pa je brend odrađen tekstualno + solid fallback
// bojama (bgcolor), a layout kroz <table> — "bulletproof" responsive email.
$preheader = 'Nova poruka od ' . $name . ' — ' . $subject;

$html = '<!DOCTYPE html>
<html lang="sr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Nova poruka — VUG</title>
<style>
  body { margin:0 !important; padding:0 !important; width:100% !important; }
  table { border-collapse:collapse; }
  img { border:0; line-height:100%; outline:none; text-decoration:none; -ms-interpolation-mode:bicubic; }
  a { text-decoration:none; }
  /* Mobilni: kartica ide 100% širine, manji padding */
  @media only screen and (max-width:620px) {
    .vug-card   { width:100% !important; border-radius:0 !important; }
    .vug-pad    { padding-left:22px !important; padding-right:22px !important; }
    .vug-wrap   { padding:16px 0 !important; }
    .vug-h1     { font-size:22px !important; }
    .vug-brand  { font-size:26px !important; }
    .vug-stack  { display:block !important; width:100% !important; text-align:left !important; padding:0 !important; }
    .vug-stack-r{ text-align:left !important; padding-top:12px !important; }
  }
  /* Tamni režim — samo suptilno, kartica ostaje čitljiva */
  @media (prefers-color-scheme: dark) {
    .vug-body { background:#07040f !important; }
  }
</style>
</head>
<body class="vug-body" style="margin:0;padding:0;width:100%;background:#0d0820;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Helvetica,Arial,sans-serif;color:#1a1030;">

<!-- Preheader (skriveni tekst u pregledu inboxa) -->
<div style="display:none;max-height:0;overflow:hidden;mso-hide:all;font-size:1px;line-height:1px;color:#0d0820;">' . safe($preheader) . '&#8203;&#8203;&#8203;&#8203;&#8203;&#8203;&#8203;&#8203;&#8203;&#8203;</div>

<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#0d0820" style="background:#0d0820;">
  <tr><td class="vug-wrap" align="center" style="padding:40px 16px;">

    <table role="presentation" class="vug-card" width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="width:600px;max-width:600px;background:#ffffff;border-radius:18px;overflow:hidden;">

      <!-- Akcentna linija -->
      <tr><td height="4" bgcolor="#3c92de" style="height:4px;line-height:4px;font-size:0;background:#3c92de;background:linear-gradient(90deg,#7ee0f7 0%,#3c92de 100%);">&nbsp;</td></tr>

      <!-- Header (tamni brend) -->
      <tr><td class="vug-pad" bgcolor="#0d0820" style="background:#0d0820;background:linear-gradient(135deg,#171033 0%,#0d0820 100%);padding:28px 36px;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
          <td class="vug-stack" style="vertical-align:middle;">
            <div class="vug-brand" style="font-size:28px;font-weight:800;color:#ffffff;letter-spacing:-0.5px;line-height:1;">VU<span style="color:#7ee0f7;">G</span></div>
            <div style="font-size:11px;font-weight:700;color:#9db3d9;letter-spacing:3px;margin-top:7px;">DIGITAL AGENCY</div>
          </td>
          <td class="vug-stack vug-stack-r" style="vertical-align:middle;text-align:right;">
            <a href="https://' . safe($siteHost) . '" style="color:#7ee0f7;font-size:13px;font-weight:600;">' . safe($siteHost) . '</a>
          </td>
        </tr></table>
      </td></tr>

      <!-- Naslov -->
      <tr><td class="vug-pad" style="padding:34px 36px 6px;">
        <div style="display:inline-block;padding:6px 14px;background:#eaf4fd;color:#2b7bc0;border-radius:100px;font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;">Nova poruka</div>
        <h1 class="vug-h1" style="margin:16px 0 4px;font-size:25px;color:#0d0820;letter-spacing:-0.3px;font-weight:800;">Stigla je nova poruka sa sajta</h1>
        <p style="margin:0;color:#8a879c;font-size:14px;">' . safe($dateStr) . '</p>
      </td></tr>

      <!-- Polja -->
      <tr><td class="vug-pad" style="padding:22px 36px 12px;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">

          <tr><td style="padding:14px 0;border-bottom:1px solid #eef0f7;">
            <div style="font-size:11px;color:#9a98ab;text-transform:uppercase;letter-spacing:0.09em;font-weight:700;">Ime i prezime</div>
            <div style="font-size:17px;color:#0d0820;font-weight:600;margin-top:5px;">' . safe($name) . '</div>
          </td></tr>

          <tr><td style="padding:14px 0;border-bottom:1px solid #eef0f7;">
            <div style="font-size:11px;color:#9a98ab;text-transform:uppercase;letter-spacing:0.09em;font-weight:700;">Email</div>
            <div style="font-size:17px;font-weight:600;margin-top:5px;">
              <a href="mailto:' . safe($email) . '" style="color:#2b7bc0;">' . safe($email) . '</a>
            </div>
          </td></tr>

          <tr><td style="padding:14px 0;border-bottom:1px solid #eef0f7;">
            <div style="font-size:11px;color:#9a98ab;text-transform:uppercase;letter-spacing:0.09em;font-weight:700;">Naslov</div>
            <div style="font-size:17px;color:#0d0820;font-weight:600;margin-top:5px;">' . safe($subject) . '</div>
          </td></tr>

          <tr><td style="padding:18px 0 6px;">
            <div style="font-size:11px;color:#9a98ab;text-transform:uppercase;letter-spacing:0.09em;font-weight:700;margin-bottom:10px;">Poruka</div>
            <div style="font-size:15px;color:#2a2540;line-height:1.7;background:#f5f7fd;border-left:3px solid #3c92de;padding:18px 20px;border-radius:10px;white-space:pre-wrap;word-break:break-word;">' . nl2br(safe($message)) . '</div>
          </td></tr>

        </table>
      </td></tr>

      <!-- CTA (bulletproof dugme sa solid fallback-om za Outlook) -->
      <tr><td class="vug-pad" style="padding:14px 36px 30px;">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0"><tr>
          <td bgcolor="#3c92de" style="border-radius:100px;background:#3c92de;background:linear-gradient(135deg,#4aa0e6 0%,#2b7bc0 100%);">
            <a href="mailto:' . safe($email) . '?subject=Re:%20' . rawurlencode($subject) . '" style="display:inline-block;padding:14px 30px;color:#ffffff;font-weight:700;font-size:14px;border-radius:100px;">&#9993;&nbsp;&nbsp;Odgovori na poruku</a>
          </td>
        </tr></table>
      </td></tr>

      <!-- Meta -->
      <tr><td class="vug-pad" bgcolor="#f9fafe" style="padding:18px 36px;background:#f9fafe;border-top:1px solid #eef0f7;font-size:12px;color:#9a98ab;font-family:Consolas,Menlo,Monaco,monospace;line-height:1.6;">
        <div>IP:&nbsp;&nbsp;' . safe($ip) . '</div>
        <div>UA:&nbsp;&nbsp;' . safe(substr($ua, 0, 160)) . '</div>
        <div>Jezik:&nbsp;&nbsp;' . safe($lang) . '</div>
      </td></tr>

      <!-- Footer -->
      <tr><td bgcolor="#0d0820" style="padding:24px 36px;background:#0d0820;text-align:center;">
        <div style="color:#ffffff;font-size:13px;font-weight:700;letter-spacing:0.02em;">VUG — Digitalna agencija</div>
        <div style="color:#7d7a99;font-size:11px;margin-top:5px;">Pančevo · Srbija &nbsp;·&nbsp; <a href="https://' . safe($siteHost) . '" style="color:#7d7a99;">' . safe($siteHost) . '</a></div>
      </td></tr>

    </table>

  </td></tr>
</table>
</body>
</html>';

// ====== PLAIN TEXT FALLBACK ======
$plain  = "Nova poruka — VUG\n";
$plain .= str_repeat('=', 40) . "\n\n";
$plain .= "Ime:     $name\n";
$plain .= "Email:   $email\n";
$plain .= "Naslov:  $subject\n";
$plain .= "Datum:   $dateStr\n\n";
$plain .= str_repeat('-', 40) . "\n";
$plain .= "Poruka:\n\n$message\n\n";
$plain .= str_repeat('-', 40) . "\n";
$plain .= "IP: $ip\n";

// ====== POSILJKA ======
$boundary = '----vug=' . bin2hex(random_bytes(8));

$headers   = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: multipart/alternative; boundary="' . $boundary . '"';
$headers[] = 'From: ' . sprintf('%s <%s>', $FROM_NAME, $FROM_EMAIL);
$headers[] = 'Reply-To: ' . sprintf('%s <%s>', $name, $email);
$headers[] = 'X-Mailer: VUG/1.0';

$body  = "--$boundary\r\n";
$body .= "Content-Type: text/plain; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$body .= $plain . "\r\n\r\n";
$body .= "--$boundary\r\n";
$body .= "Content-Type: text/html; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$body .= $html . "\r\n\r\n";
$body .= "--$boundary--";

$mailSubject = '[VUG] ' . $subject;
// =?UTF-8?B? encoding za subject da bi specijalni karakteri (č, š, ž) prosli
$encodedSubject = '=?UTF-8?B?' . base64_encode($mailSubject) . '?=';

$sent = @mail(
    $TO_EMAIL,
    $encodedSubject,
    $body,
    implode("\r\n", $headers),
    '-f' . $FROM_EMAIL
);

if (!$sent) {
    // Log gresku za debugging
    error_log('[VUG] mail() failed for ' . $email);
    respond([
        'ok' => false,
        'message' => $t['form_error']
    ], 500);
}

respond([
    'ok' => true,
    'message' => $t['form_success']
]);