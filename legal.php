<?php
/**
 * VUG — pravne stranice (Politika privatnosti / Uslovi korišćenja / Politika kolačića).
 *
 * NAPOMENA: Tekst je NACRT zasnovan na stvarnom ponašanju sajta (kontakt forma,
 * Google Analytics, reCAPTCHA). Pre objavljivanja MORA ga pregledati pravnik i
 * dopuniti zvanične podatke o firmi (PIB, matični broj, registracioni podaci).
 * Do tada su stranice noindex (ne indeksiraju se), ali su dostupne i povezane u futeru.
 */

$doc  = $_GET['doc'] ?? 'privacy';
if (!in_array($doc, ['privacy', 'terms', 'cookies'], true)) $doc = 'privacy';

$req  = $_SERVER['REQUEST_URI'] ?? '';
$lang = (preg_match('#/en(/|$|\?)#', $req) || (($_GET['lang'] ?? '') === 'en')) ? 'en' : 'sr';
$t = require __DIR__ . '/lang/' . $lang . '.php';
require __DIR__ . '/php/icons.php';

$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
$home = $base === '' ? '/' : $base . '/';
if ($lang === 'en') $home = $base . '/en';

// Clean rute (rade i u podfolderu i u rootu). EN dobija ?lang=en.
$q = $lang === 'en' ? '?lang=en' : '';
$routes = [
    'privacy' => $base . '/politika-privatnosti' . $q,
    'terms'   => $base . '/uslovi-koriscenja' . $q,
    'cookies' => $base . '/politika-kolacica' . $q,
];

$company = 'VUG';
$addr    = $t['contact_info_location'];

// Email u pravnim tekstovima ide kao %EMAIL% token, a ne kao čista adresa:
// legal_text() prvo escapuje tekst, pa token zameni HTML-entity obfuskacijom
// (vug_email_obf) — pregledač prikaže adresu normalno, a spam harvesteri
// (i SEO skeneri koji broje "email u izvornom kodu") ne vide ništa.
$email_plain = $t['contact_info_email'];
$email       = '%EMAIL%';
$legal_text  = static function (string $s) use ($email_plain): string {
    return str_replace('%EMAIL%', vug_email_obf($email_plain), htmlspecialchars($s));
};

/* ---------- Sadržaj (bilingvalno) ---------- */
$C = [];

$C['sr'] = [
    'review' => 'Napomena: ovo je radni nacrt. Konačan pravni tekst treba da pregleda i potvrdi pravnik pre objavljivanja.',
    'updated'=> 'Poslednje ažuriranje',
    'back'   => 'Nazad na početnu',
    'privacy' => [
        'title' => 'Politika privatnosti',
        'intro' => "Ova politika objašnjava koje podatke {$company} prikuplja putem sajta, u koje svrhe i koja su Vaša prava. Za sva pitanja pišite na {$email}.",
        'sections' => [
            ['Podaci koje prikupljamo', "Kada popunite kontakt formu, prikupljamo podatke koje sami unesete: ime i prezime, email adresu, naslov i sadržaj poruke. Server dodatno beleži IP adresu i podatke o pregledaču radi zaštite od zloupotrebe (spam) i bezbednosti."],
            ['Svrha obrade', 'Podatke koristimo isključivo da odgovorimo na Vaš upit i uspostavimo kontakt u vezi sa uslugama. Ne koristimo ih za automatsko donošenje odluka niti ih prodajemo trećim licima.'],
            ['Pravni osnov', 'Obrada se zasniva na Vašem pristanku koji dajete slanjem forme, odnosno na legitimnom interesu za komunikaciju sa potencijalnim klijentima. [Za proveru pravnika: precizan pravni osnov po Zakonu o zaštiti podataka o ličnosti.]'],
            ['Analitika (Google Analytics)', 'Sajt koristi Google Analytics za anonimnu statistiku poseta (broj posetilaca, izvori saobraćaja, ponašanje na stranici). Google može postavljati kolačiće — više u Politici kolačića.'],
            ['Zaštita od spama (Google reCAPTCHA)', 'Kontakt forma je zaštićena Google reCAPTCHA v3 servisom radi sprečavanja zloupotrebe. Na reCAPTCHA se primenjuju Google-ova Politika privatnosti i Uslovi korišćenja.'],
            ['Čuvanje podataka', 'Poruke iz kontakt forme čuvamo onoliko koliko je potrebno da obradimo Vaš upit i eventualnu saradnju. [Za proveru pravnika: tačan rok čuvanja.]'],
            ['Vaša prava', 'Imate pravo na pristup, ispravku, brisanje i ograničenje obrade svojih podataka, kao i pravo na prigovor. Zahtev možete poslati na ' . $email . '.'],
            ['Kontakt', "Rukovalac podacima: {$company}, {$addr}. Email: {$email}. [Za proveru pravnika: PIB, matični broj i zvanični naziv pravnog lica.]"],
        ],
    ],
    'terms' => [
        'title' => 'Uslovi korišćenja',
        'intro' => "Korišćenjem sajta {$company} prihvatate uslove navedene u nastavku.",
        'sections' => [
            ['Sadržaj sajta', 'Sajt ima informativni i prezentacioni karakter. Trudimo se da informacije budu tačne i ažurne, ali ne garantujemo da su u svakom trenutku potpune ili bez grešaka.'],
            ['Usluge i ponude', 'Prikazane usluge ne predstavljaju obavezujuću ponudu. Konkretni obim, rok i cena definišu se posebnom ponudom nakon konsultacija.'],
            ['Intelektualna svojina', "Logo, tekstovi, dizajn i ostali sadržaj na sajtu su vlasništvo {$company}-a ili se koriste uz dozvolu i ne smeju se koristiti bez odobrenja."],
            ['Linkovi ka trećim stranama', 'Sajt može sadržati linkove ka sajtovima trećih strana (npr. profili klijenata, društvene mreže). Ne odgovaramo za sadržaj i politike tih sajtova.'],
            ['Ograničenje odgovornosti', 'Ne odgovaramo za eventualnu štetu nastalu korišćenjem sajta u meri dozvoljenoj zakonom. [Za proveru pravnika.]'],
            ['Izmene uslova', 'Zadržavamo pravo izmene ovih uslova. Važeća verzija je uvek objavljena na ovoj stranici.'],
            ['Kontakt', "Za pitanja u vezi sa uslovima: {$email}."],
        ],
    ],
    'cookies' => [
        'title' => 'Politika kolačića',
        'intro' => 'Ova politika objašnjava kako sajt koristi kolačiće i slične tehnologije.',
        'sections' => [
            ['Šta su kolačići', 'Kolačići su male tekstualne datoteke koje sajt čuva u Vašem pregledaču kako bi funkcionisao ispravno i merio posete.'],
            ['Neophodni kolačići', 'Potrebni za osnovno funkcionisanje sajta i bezbednost (npr. zaštita kontakt forme putem reCAPTCHA).'],
            ['Analitički kolačići', 'Google Analytics postavlja kolačiće za anonimnu statistiku poseta. Ovi kolačići pomažu da razumemo kako se sajt koristi i da ga unapredimo.'],
            ['Kolačići trećih strana', 'Google (Analytics, reCAPTCHA) može postavljati sopstvene kolačiće u skladu sa svojim politikama privatnosti.'],
            ['Upravljanje kolačićima', 'Kolačiće možete obrisati ili blokirati u podešavanjima svog pregledača. Blokiranje pojedinih kolačića može uticati na funkcionalnost sajta. [Za proveru pravnika: potreba za cookie-consent banerom.]'],
            ['Kontakt', "Za pitanja u vezi sa kolačićima: {$email}."],
        ],
    ],
];

$C['en'] = [
    'review' => 'Note: this is a working draft. The final legal text should be reviewed and approved by a lawyer before publishing.',
    'updated'=> 'Last updated',
    'back'   => 'Back to home',
    'privacy' => [
        'title' => 'Privacy Policy',
        'intro' => "This policy explains what data {$company} collects through the website, for what purposes and what your rights are. For any questions, email {$email}.",
        'sections' => [
            ['Data we collect', 'When you fill in the contact form we collect the data you enter: full name, email address, subject and message. The server additionally logs the IP address and browser information to protect against abuse (spam) and for security.'],
            ['Purpose of processing', 'We use the data solely to respond to your enquiry and get in touch regarding our services. We do not use it for automated decision‑making and we do not sell it to third parties.'],
            ['Legal basis', 'Processing is based on the consent you give by submitting the form, or on the legitimate interest of communicating with prospective clients. [For lawyer review: exact legal basis under applicable data protection law.]'],
            ['Analytics (Google Analytics)', 'The site uses Google Analytics for anonymous visit statistics (visitor count, traffic sources, on‑page behaviour). Google may set cookies — see the Cookie Policy.'],
            ['Spam protection (Google reCAPTCHA)', 'The contact form is protected by Google reCAPTCHA v3 to prevent abuse. Google’s Privacy Policy and Terms of Service apply to reCAPTCHA.'],
            ['Data retention', 'We keep contact‑form messages for as long as needed to handle your enquiry and any collaboration. [For lawyer review: exact retention period.]'],
            ['Your rights', 'You have the right to access, rectify, erase and restrict the processing of your data, as well as the right to object. Requests can be sent to ' . $email . '.'],
            ['Contact', "Data controller: {$company}, {$addr}. Email: {$email}. [For lawyer review: company registration details and official legal name.]"],
        ],
    ],
    'terms' => [
        'title' => 'Terms of Use',
        'intro' => "By using the {$company} website you accept the terms below.",
        'sections' => [
            ['Website content', 'The site is informational and presentational. We strive to keep information accurate and up to date but do not guarantee it is always complete or error‑free.'],
            ['Services and offers', 'The services shown do not constitute a binding offer. The specific scope, timeline and price are defined in a separate quote after consultation.'],
            ['Intellectual property', "The logo, texts, design and other content on the site are owned by {$company} or used with permission and may not be used without approval."],
            ['Third‑party links', 'The site may contain links to third‑party websites (e.g. client profiles, social media). We are not responsible for the content or policies of those sites.'],
            ['Limitation of liability', 'We are not liable for any damage arising from use of the site to the extent permitted by law. [For lawyer review.]'],
            ['Changes to the terms', 'We reserve the right to change these terms. The current version is always published on this page.'],
            ['Contact', "For questions about the terms: {$email}."],
        ],
    ],
    'cookies' => [
        'title' => 'Cookie Policy',
        'intro' => 'This policy explains how the site uses cookies and similar technologies.',
        'sections' => [
            ['What cookies are', 'Cookies are small text files a site stores in your browser so it can work correctly and measure visits.'],
            ['Essential cookies', 'Required for basic site functionality and security (e.g. contact‑form protection via reCAPTCHA).'],
            ['Analytics cookies', 'Google Analytics sets cookies for anonymous visit statistics. These help us understand how the site is used and improve it.'],
            ['Third‑party cookies', 'Google (Analytics, reCAPTCHA) may set its own cookies in accordance with its privacy policies.'],
            ['Managing cookies', 'You can delete or block cookies in your browser settings. Blocking some cookies may affect site functionality. [For lawyer review: whether a cookie‑consent banner is required.]'],
            ['Contact', "For questions about cookies: {$email}."],
        ],
    ],
];

$page = $C[$lang][$doc];
$labels = $C[$lang];
$updated = date('d.m.Y.', @filemtime(__FILE__) ?: time());

/* ── Zajednički layout (partials/head + header + footer) ── */
$SITE_URL    = 'https://vugagency.com';
$phone_clean = preg_replace('/\s+/', '', $t['contact_info_phone']);
$doc_slugs   = ['privacy' => 'politika-privatnosti', 'terms' => 'uslovi-koriscenja', 'cookies' => 'politika-kolacica'];
$slug        = $doc_slugs[$doc];

$meta_title       = $page['title'] . ' — VUG';
// Meta description ne sme da sadrži %EMAIL% token (ni samu adresu) — izbacujemo
// celu rečenicu u kojoj se nalazi; opis i tako treba da bude kratak.
$meta_description = trim(preg_replace('/\s*[^.]*%EMAIL%[^.]*\.\s*/u', ' ', $page['intro']));
$canonical        = $SITE_URL . '/' . $slug . ($lang === 'en' ? '?lang=en' : '');
$robots           = 'noindex, follow';
$href_other       = $base . '/' . $slug . ($lang === 'sr' ? '?lang=en' : '');

$nav_prefix       = $home;
$contact_href     = $home . '#contact';
$cta_href         = $home . '#contact';
$show_lang_toggle = true;

$extra_head = <<<'HTML'
    <style>
        .legal-wrap{max-width:820px;margin:0 auto;padding:calc(var(--nav-h) + 60px) 20px 80px;position:relative;z-index:1;}
        .legal-back{display:inline-flex;align-items:center;gap:8px;color:var(--txt-soft);font-weight:600;font-size:14px;margin-bottom:28px;}
        .legal-back:hover{color:var(--mint);}
        .legal-h1{font-size:clamp(30px,5vw,50px);font-weight:800;letter-spacing:-.03em;color:var(--txt);}
        .legal-updated{color:var(--txt-muted);font-family:var(--ff-mono);font-size:13px;margin-top:10px;}
        .legal-intro{color:var(--txt-soft);font-size:18px;line-height:1.6;margin:22px 0 8px;}
        .legal-review{display:flex;gap:12px;align-items:flex-start;margin:26px 0 10px;padding:16px 18px;border-radius:14px;
            background:rgba(255,200,87,.09);border:1px solid rgba(255,200,87,.3);color:#ffd98a;font-size:14px;line-height:1.55;}
        .legal-section{margin-top:34px;}
        .legal-section h2{font-size:clamp(19px,2.4vw,24px);font-weight:700;color:var(--txt);letter-spacing:-.02em;}
        .legal-section p{color:var(--txt-soft);line-height:1.7;margin-top:10px;}
        .legal-nav{display:flex;flex-wrap:wrap;gap:10px;margin-top:14px;}
        .legal-nav a{padding:8px 16px;border-radius:100px;border:1px solid var(--line-strong);color:var(--txt-soft);font-size:13px;font-weight:600;}
        .legal-nav a[aria-current]{background:var(--mint);color:var(--deep);border-color:var(--mint);}
        .legal-nav a:hover{color:var(--mint);}
        .legal-nav a[aria-current]:hover{color:var(--deep);}
    </style>
HTML;

require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<div class="legal-wrap">
    <a class="legal-back" href="<?= $home ?>"><?= vug_icon('arrow-right') ?> <?= htmlspecialchars($labels['back']) ?></a>

    <div class="legal-nav">
        <a href="<?= $routes['privacy'] ?>"<?= $doc==='privacy'?' aria-current="page"':'' ?>><?= $t['footer_privacy'] ?></a>
        <a href="<?= $routes['terms'] ?>"<?= $doc==='terms'?' aria-current="page"':'' ?>><?= $t['footer_terms'] ?></a>
        <a href="<?= $routes['cookies'] ?>"<?= $doc==='cookies'?' aria-current="page"':'' ?>><?= $t['footer_cookies'] ?></a>
    </div>

    <h1 class="legal-h1"><?= htmlspecialchars($page['title']) ?></h1>
    <div class="legal-updated"><?= htmlspecialchars($labels['updated']) ?>: <?= $updated ?></div>

    <div class="legal-review"><?= vug_icon('briefcase') ?> <span><?= htmlspecialchars($labels['review']) ?></span></div>

    <p class="legal-intro"><?= $legal_text($page['intro']) ?></p>

    <?php foreach ($page['sections'] as $s): ?>
    <section class="legal-section">
        <h2><?= htmlspecialchars($s[0]) ?></h2>
        <p><?= $legal_text($s[1]) ?></p>
    </section>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
