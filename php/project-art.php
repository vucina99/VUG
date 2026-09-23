<?php
/**
 * VUG - generator SVG ilustracija za portfolio ("kreirane slike").
 *
 * Projekti nemaju fotografije, pa se vizuali generišu proceduralno: svaki
 * projekat dobija svoj akcentni par boja (iz palete sajta) i seed, pa su
 * mockup-i međusobno različiti. Rezultat se ZAPISUJE u /img/projects/*.svg
 * skriptom php/gen-project-art.php (pokrenuti ručno, nema build stepa):
 *
 *     php php/gen-project-art.php
 *
 * Zašto fajlovi, a ne inline SVG: <img loading="lazy"> + immutable cache
 * (.htaccess) => portfolio sa 12 kartica ne naduvava HTML.
 *
 * Vrste (kind): web, app, mobile, social, booking, shop, brand, analytics.
 * Sve su 1200x750 (16:10) da grid nikad ne "skače".
 *
 * Social projekti dodatno dobijaju formate u kojima sadržaj i nastaje:
 *   vug_art_grid_svg()      -> 900x900  (mreža profila 3x3)
 *   vug_art_vertical_svg()  -> 720x1280 (reel / story / carousel)
 */

if (!function_exists('vug_art_svg')) {

/** Determinističan pseudo-random u opsegu [$min,$max] (seed se prosleđuje kroz $st). */
function vug_art_rand(array &$st, int $min, int $max): int {
    // xorshift32 - isti rezultat na svakoj mašini (mt_rand nije garantovano stabilan)
    $x = $st['s'];
    $x ^= ($x << 13) & 0xFFFFFFFF;
    $x ^= ($x >> 17);
    $x ^= ($x << 5) & 0xFFFFFFFF;
    $st['s'] = $x & 0xFFFFFFFF;
    return $min + (int) ($st['s'] % max(1, ($max - $min + 1)));
}

/**
 * Vraća kompletan <svg> string.
 *
 * @param string $kind  web|app|mobile|social|booking|shop|brand|analytics
 * @param array  $o     ['a1'=>hex, 'a2'=>hex, 'seed'=>int, 'alt'=>string]
 */
function vug_art_svg(string $kind, array $o = []): string {
    $a1   = $o['a1']   ?? '#5dd3f5';
    $a2   = $o['a2']   ?? '#cffbf6';
    $seed = (int) ($o['seed'] ?? 7);
    $alt  = $o['alt']  ?? 'VUG projekat';
    $st   = ['s' => ($seed * 2654435761) & 0xFFFFFFFF ?: 12345];

    $W = 1200; $H = 750;
    $uid = 'a' . substr(md5($kind . $seed . $a1), 0, 6); // jedinstveni id-evi (više SVG-ova na strani)

    $defs = <<<SVG
  <defs>
    <linearGradient id="{$uid}acc" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="{$a1}"/><stop offset="1" stop-color="{$a2}"/>
    </linearGradient>
    <linearGradient id="{$uid}accV" x1="0" y1="1" x2="0" y2="0">
      <stop offset="0" stop-color="{$a1}" stop-opacity="0"/><stop offset="1" stop-color="{$a1}" stop-opacity=".55"/>
    </linearGradient>
    <linearGradient id="{$uid}panel" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#241a44"/><stop offset="1" stop-color="#160f30"/>
    </linearGradient>
    <linearGradient id="{$uid}deep" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#4f4698"/><stop offset="1" stop-color="#241a44"/>
    </linearGradient>
    <filter id="{$uid}sh" x="-25%" y="-25%" width="150%" height="150%">
      <feDropShadow dx="0" dy="26" stdDeviation="34" flood-color="{$a1}" flood-opacity=".22"/>
    </filter>
    <filter id="{$uid}blur" x="-50%" y="-50%" width="200%" height="200%">
      <feGaussianBlur stdDeviation="52"/>
    </filter>
    <clipPath id="{$uid}clip"><rect x="0" y="0" width="{$W}" height="{$H}" rx="0"/></clipPath>
  </defs>
SVG;

    // Pozadina: deep-purple osnova + dva obojena "blob"-a u akcentima (nikad ravno ljubičasto)
    $bx1 = vug_art_rand($st, 120, 460);
    $by1 = vug_art_rand($st, 60, 260);
    $bx2 = vug_art_rand($st, 700, 1080);
    $by2 = vug_art_rand($st, 420, 660);
    $bg = <<<SVG
  <rect width="{$W}" height="{$H}" fill="#120c28"/>
  <g filter="url(#{$uid}blur)" opacity=".9">
    <circle cx="{$bx1}" cy="{$by1}" r="250" fill="{$a1}" opacity=".42"/>
    <circle cx="{$bx2}" cy="{$by2}" r="290" fill="{$a2}" opacity=".26"/>
    <circle cx="620" cy="380" r="210" fill="#4f4698" opacity=".55"/>
  </g>
  <g opacity=".10" stroke="#ffffff" stroke-width="1">
SVG;
    for ($x = 0; $x <= $W; $x += 60) { $bg .= "\n    <line x1=\"{$x}\" y1=\"0\" x2=\"{$x}\" y2=\"{$H}\"/>"; }
    for ($y = 0; $y <= $H; $y += 60) { $bg .= "\n    <line x1=\"0\" y1=\"{$y}\" x2=\"{$W}\" y2=\"{$y}\"/>"; }
    $bg .= "\n  </g>";

    $body = '';

    switch ($kind) {

        /* ---------- WEB SAJT: desktop browser prozor ---------- */
        case 'web': {
            $body .= <<<SVG
  <g filter="url(#{$uid}sh)">
    <rect x="110" y="90" width="980" height="600" rx="24" fill="url(#{$uid}panel)" stroke="#ffffff" stroke-opacity=".14"/>
    <path d="M110 114a24 24 0 0 1 24-24h932a24 24 0 0 1 24 24v42H110z" fill="#2b1f52"/>
    <circle cx="152" cy="123" r="7" fill="{$a1}"/><circle cx="178" cy="123" r="7" fill="{$a2}"/><circle cx="204" cy="123" r="7" fill="#abbbe5"/>
    <rect x="240" y="112" width="600" height="22" rx="11" fill="#ffffff" fill-opacity=".07"/>
    <rect x="256" y="119" width="150" height="8" rx="4" fill="{$a1}" fill-opacity=".7"/>
    <rect x="880" y="112" width="70" height="22" rx="11" fill="url(#{$uid}acc)" fill-opacity=".85"/>

    <!-- hero -->
    <rect x="150" y="196" width="330" height="26" rx="13" fill="url(#{$uid}acc)"/>
    <rect x="150" y="238" width="260" height="26" rx="13" fill="#ffffff" fill-opacity=".26"/>
    <rect x="150" y="290" width="380" height="11" rx="6" fill="#ffffff" fill-opacity=".16"/>
    <rect x="150" y="312" width="320" height="11" rx="6" fill="#ffffff" fill-opacity=".12"/>
    <rect x="150" y="352" width="150" height="42" rx="21" fill="url(#{$uid}acc)"/>
    <rect x="316" y="352" width="120" height="42" rx="21" fill="none" stroke="#ffffff" stroke-opacity=".3"/>

    <!-- vizual -->
    <rect x="590" y="196" width="440" height="270" rx="18" fill="url(#{$uid}deep)" stroke="#ffffff" stroke-opacity=".12"/>
    <circle cx="672" cy="272" r="26" fill="{$a2}" opacity=".9"/>
    <path d="M614 430l86-78 62 48 46-38 82 68v10H614z" fill="{$a1}" opacity=".55"/>
    <rect x="614" y="220" width="90" height="9" rx="4.5" fill="#ffffff" fill-opacity=".22"/>

    <!-- kartice -->
    <g>
      <rect x="150" y="452" width="270" height="180" rx="16" fill="#ffffff" fill-opacity=".055" stroke="#ffffff" stroke-opacity=".1"/>
      <rect x="440" y="452" width="270" height="180" rx="16" fill="#ffffff" fill-opacity=".055" stroke="#ffffff" stroke-opacity=".1"/>
      <rect x="730" y="452" width="300" height="180" rx="16" fill="#ffffff" fill-opacity=".055" stroke="#ffffff" stroke-opacity=".1"/>
      <circle cx="184" cy="490" r="14" fill="{$a1}"/><circle cx="474" cy="490" r="14" fill="{$a2}"/><circle cx="764" cy="490" r="14" fill="#abbbe5"/>
      <rect x="174" y="528" width="170" height="10" rx="5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="464" y="528" width="170" height="10" rx="5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="754" y="528" width="190" height="10" rx="5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="174" y="552" width="120" height="10" rx="5" fill="#ffffff" fill-opacity=".12"/>
      <rect x="464" y="552" width="140" height="10" rx="5" fill="#ffffff" fill-opacity=".12"/>
      <rect x="754" y="552" width="110" height="10" rx="5" fill="#ffffff" fill-opacity=".12"/>
      <rect x="174" y="588" width="90" height="22" rx="11" fill="{$a1}" fill-opacity=".25"/>
      <rect x="464" y="588" width="90" height="22" rx="11" fill="{$a2}" fill-opacity=".25"/>
      <rect x="754" y="588" width="90" height="22" rx="11" fill="#abbbe5" fill-opacity=".25"/>
    </g>
  </g>
SVG;
            break;
        }

        /* ---------- WEB APLIKACIJA: dashboard sa grafikonima ---------- */
        case 'app':
        case 'analytics': {
            // linija grafikona iz seed-a
            $pts = []; $bars = [];
            for ($i = 0; $i < 12; $i++) { $pts[] = vug_art_rand($st, 20, 100); }
            for ($i = 0; $i < 8; $i++)  { $bars[] = vug_art_rand($st, 26, 118); }
            $line = ''; $area = '';
            foreach ($pts as $i => $v) {
                $px = 640 + $i * 34;
                $py = 452 - $v;
                $line .= ($i === 0 ? "M{$px} {$py}" : " L{$px} {$py}");
            }
            $area = $line . ' L1014 452 L640 452 Z';
            $barsSvg = '';
            foreach ($bars as $i => $v) {
                $bx = 190 + $i * 40;
                $by = 620 - $v;
                $fill = $i % 3 === 0 ? $a1 : ($i % 3 === 1 ? $a2 : '#abbbe5');
                $barsSvg .= "\n    <rect x=\"{$bx}\" y=\"{$by}\" width=\"24\" height=\"{$v}\" rx=\"8\" fill=\"{$fill}\" opacity=\".8\"/>";
            }
            // Lista/tabela u desnoj koloni (4 reda: avatar + naziv + status)
            $rows = '';
            for ($i = 0; $i < 4; $i++) {
                $ry   = 500 + $i * 38;
                $w    = vug_art_rand($st, 110, 210);
                $tone = $i % 2 === 0 ? $a1 : $a2;
                $cy   = $ry + 17;
                $ty   = $ry + 12;
                $rows .= "\n    <rect x=\"640\" y=\"{$ry}\" width=\"390\" height=\"34\" rx=\"10\" fill=\"#ffffff\" fill-opacity=\".05\"/>";
                $rows .= "\n    <circle cx=\"664\" cy=\"{$cy}\" r=\"9\" fill=\"{$tone}\" opacity=\".75\"/>";
                $rows .= "\n    <rect x=\"686\" y=\"{$ty}\" width=\"{$w}\" height=\"10\" rx=\"5\" fill=\"#ffffff\" fill-opacity=\".2\"/>";
                $rows .= "\n    <rect x=\"960\" y=\"{$ty}\" width=\"54\" height=\"10\" rx=\"5\" fill=\"{$tone}\" fill-opacity=\".45\"/>";
            }

            $body .= <<<SVG
  <g filter="url(#{$uid}sh)">
    <rect x="80" y="80" width="1040" height="600" rx="26" fill="url(#{$uid}panel)" stroke="#ffffff" stroke-opacity=".14"/>

    <!-- sidebar -->
    <path d="M80 106a26 26 0 0 1 26-26h114v600H106a26 26 0 0 1-26-26z" fill="#ffffff" fill-opacity=".04"/>
    <rect x="104" y="112" width="34" height="34" rx="11" fill="url(#{$uid}acc)"/>
    <rect x="148" y="123" width="48" height="12" rx="6" fill="#ffffff" fill-opacity=".26"/>
    <rect x="100" y="188" width="80" height="34" rx="10" fill="{$a1}" fill-opacity=".18"/>
    <rect x="112" y="200" width="10" height="10" rx="3" fill="{$a1}"/>
    <rect x="132" y="201" width="42" height="8" rx="4" fill="{$a1}" fill-opacity=".8"/>
SVG;
            for ($i = 0; $i < 5; $i++) {
                $y = 236 + $i * 38;
                $w = vug_art_rand($st, 30, 54);
                $body .= "\n    <rect x=\"112\" y=\"" . ($y + 12) . "\" width=\"10\" height=\"10\" rx=\"3\" fill=\"#ffffff\" fill-opacity=\".22\"/>";
                $body .= "\n    <rect x=\"132\" y=\"" . ($y + 13) . "\" width=\"{$w}\" height=\"8\" rx=\"4\" fill=\"#ffffff\" fill-opacity=\".16\"/>";
            }

            $body .= <<<SVG

    <!-- topbar -->
    <rect x="220" y="80" width="900" height="72" fill="#ffffff" fill-opacity=".03"/>
    <rect x="252" y="106" width="180" height="18" rx="9" fill="#ffffff" fill-opacity=".24"/>
    <rect x="760" y="102" width="200" height="26" rx="13" fill="#ffffff" fill-opacity=".06"/>
    <rect x="984" y="100" width="30" height="30" rx="10" fill="url(#{$uid}acc)"/>
    <circle cx="1058" cy="115" r="15" fill="url(#{$uid}deep)" stroke="#ffffff" stroke-opacity=".2"/>

    <!-- KPI kartice -->
    <g>
      <rect x="252" y="184" width="180" height="110" rx="16" fill="#ffffff" fill-opacity=".05" stroke="#ffffff" stroke-opacity=".1"/>
      <rect x="450" y="184" width="180" height="110" rx="16" fill="#ffffff" fill-opacity=".05" stroke="#ffffff" stroke-opacity=".1"/>
      <rect x="648" y="184" width="180" height="110" rx="16" fill="url(#{$uid}acc)" fill-opacity=".16" stroke="{$a1}" stroke-opacity=".4"/>
      <rect x="846" y="184" width="180" height="110" rx="16" fill="#ffffff" fill-opacity=".05" stroke="#ffffff" stroke-opacity=".1"/>
      <rect x="274" y="208" width="52" height="9" rx="4.5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="472" y="208" width="52" height="9" rx="4.5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="670" y="208" width="52" height="9" rx="4.5" fill="{$a1}" fill-opacity=".7"/>
      <rect x="868" y="208" width="52" height="9" rx="4.5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="274" y="232" width="90" height="22" rx="7" fill="{$a1}" fill-opacity=".8"/>
      <rect x="472" y="232" width="72" height="22" rx="7" fill="{$a2}" fill-opacity=".8"/>
      <rect x="670" y="232" width="104" height="22" rx="7" fill="{$a2}"/>
      <rect x="868" y="232" width="80" height="22" rx="7" fill="#abbbe5" fill-opacity=".7"/>
      <rect x="274" y="266" width="120" height="8" rx="4" fill="#ffffff" fill-opacity=".1"/>
      <rect x="472" y="266" width="100" height="8" rx="4" fill="#ffffff" fill-opacity=".1"/>
      <rect x="670" y="266" width="112" height="8" rx="4" fill="#ffffff" fill-opacity=".18"/>
      <rect x="868" y="266" width="94" height="8" rx="4" fill="#ffffff" fill-opacity=".1"/>
    </g>

    <!-- bar chart -->
    <rect x="252" y="322" width="352" height="330" rx="18" fill="#ffffff" fill-opacity=".04" stroke="#ffffff" stroke-opacity=".1"/>
    <rect x="278" y="348" width="120" height="12" rx="6" fill="#ffffff" fill-opacity=".22"/>
    <rect x="278" y="374" width="70" height="8" rx="4" fill="{$a1}" fill-opacity=".6"/>
    <g transform="translate(64,0)">{$barsSvg}
    </g>
    <line x1="278" y1="622" x2="578" y2="622" stroke="#ffffff" stroke-opacity=".14"/>

    <!-- line chart + lista -->
    <rect x="624" y="322" width="422" height="150" rx="18" fill="#ffffff" fill-opacity=".04" stroke="#ffffff" stroke-opacity=".1"/>
    <path d="{$area}" fill="url(#{$uid}accV)" opacity=".5"/>
    <path d="{$line}" fill="none" stroke="{$a2}" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
    <rect x="648" y="344" width="96" height="10" rx="5" fill="#ffffff" fill-opacity=".2"/>
    <rect x="624" y="486" width="422" height="166" rx="18" fill="#ffffff" fill-opacity=".04" stroke="#ffffff" stroke-opacity=".1"/>
    {$rows}
  </g>
SVG;
            break;
        }

        /* ---------- MOBILNA APLIKACIJA: dva telefona ---------- */
        case 'mobile': {
            $body .= <<<SVG
  <g filter="url(#{$uid}sh)">
    <!-- zadnji telefon -->
    <g transform="translate(700 130) rotate(8)">
      <rect x="0" y="0" width="290" height="560" rx="42" fill="#1a1230" stroke="#ffffff" stroke-opacity=".14"/>
      <rect x="12" y="12" width="266" height="536" rx="34" fill="url(#{$uid}panel)"/>
      <rect x="110" y="26" width="70" height="10" rx="5" fill="#ffffff" fill-opacity=".18"/>
      <rect x="36" y="70" width="130" height="16" rx="8" fill="url(#{$uid}acc)"/>
      <rect x="36" y="100" width="180" height="9" rx="4.5" fill="#ffffff" fill-opacity=".16"/>
      <rect x="36" y="136" width="218" height="130" rx="18" fill="url(#{$uid}deep)" stroke="#ffffff" stroke-opacity=".1"/>
      <circle cx="80" cy="180" r="18" fill="{$a2}" opacity=".85"/>
      <rect x="36" y="288" width="104" height="104" rx="16" fill="#ffffff" fill-opacity=".06"/>
      <rect x="150" y="288" width="104" height="104" rx="16" fill="#ffffff" fill-opacity=".06"/>
      <rect x="36" y="410" width="218" height="46" rx="14" fill="{$a1}" fill-opacity=".2"/>
      <rect x="36" y="480" width="218" height="44" rx="22" fill="url(#{$uid}acc)"/>
    </g>
    <!-- prednji telefon -->
    <g transform="translate(300 100)">
      <rect x="0" y="0" width="320" height="600" rx="46" fill="#160f30" stroke="#ffffff" stroke-opacity=".18"/>
      <rect x="12" y="12" width="296" height="576" rx="38" fill="url(#{$uid}panel)"/>
      <rect x="120" y="30" width="80" height="10" rx="5" fill="#ffffff" fill-opacity=".2"/>
      <circle cx="60" cy="86" r="18" fill="url(#{$uid}acc)"/>
      <rect x="90" y="76" width="90" height="10" rx="5" fill="#ffffff" fill-opacity=".24"/>
      <rect x="90" y="92" width="58" height="8" rx="4" fill="#ffffff" fill-opacity=".14"/>
      <rect x="248" y="72" width="34" height="34" rx="11" fill="#ffffff" fill-opacity=".07"/>
      <rect x="38" y="134" width="244" height="120" rx="18" fill="url(#{$uid}deep)" stroke="#ffffff" stroke-opacity=".12"/>
      <rect x="58" y="156" width="96" height="12" rx="6" fill="{$a2}"/>
      <rect x="58" y="178" width="150" height="8" rx="4" fill="#ffffff" fill-opacity=".2"/>
      <rect x="58" y="210" width="80" height="26" rx="13" fill="{$a1}"/>
      <rect x="38" y="278" width="244" height="60" rx="16" fill="#ffffff" fill-opacity=".05" stroke="#ffffff" stroke-opacity=".08"/>
      <rect x="38" y="350" width="244" height="60" rx="16" fill="#ffffff" fill-opacity=".05" stroke="#ffffff" stroke-opacity=".08"/>
      <rect x="38" y="422" width="244" height="60" rx="16" fill="#ffffff" fill-opacity=".05" stroke="#ffffff" stroke-opacity=".08"/>
      <circle cx="70" cy="308" r="14" fill="{$a1}" opacity=".8"/>
      <circle cx="70" cy="380" r="14" fill="{$a2}" opacity=".8"/>
      <circle cx="70" cy="452" r="14" fill="#abbbe5" opacity=".8"/>
      <rect x="98" y="302" width="120" height="9" rx="4.5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="98" y="374" width="140" height="9" rx="4.5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="98" y="446" width="106" height="9" rx="4.5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="98" y="318" width="74" height="8" rx="4" fill="#ffffff" fill-opacity=".1"/>
      <rect x="98" y="390" width="90" height="8" rx="4" fill="#ffffff" fill-opacity=".1"/>
      <rect x="98" y="462" width="64" height="8" rx="4" fill="#ffffff" fill-opacity=".1"/>
      <rect x="38" y="512" width="244" height="56" rx="20" fill="#ffffff" fill-opacity=".05"/>
      <circle cx="82" cy="540" r="13" fill="url(#{$uid}acc)"/>
      <circle cx="136" cy="540" r="11" fill="#ffffff" fill-opacity=".2"/>
      <circle cx="188" cy="540" r="11" fill="#ffffff" fill-opacity=".2"/>
      <circle cx="240" cy="540" r="11" fill="#ffffff" fill-opacity=".2"/>
    </g>
  </g>
SVG;
            break;
        }

        /* ---------- SOCIAL MEDIA: feed + grid + story krugovi ---------- */
        case 'social': {
            $tiles = '';
            for ($r = 0; $r < 3; $r++) {
                for ($c = 0; $c < 3; $c++) {
                    $x = 700 + $c * 132;
                    $y = 300 + $r * 132;
                    $pick = vug_art_rand($st, 0, 3);
                    $fill = $pick === 0 ? "url(#{$uid}acc)" : ($pick === 1 ? "url(#{$uid}deep)" : ($pick === 2 ? $a1 : $a2));
                    $op   = $pick > 1 ? '.55' : '.95';
                    $tiles .= "\n    <rect x=\"{$x}\" y=\"{$y}\" width=\"120\" height=\"120\" rx=\"14\" fill=\"{$fill}\" opacity=\"{$op}\"/>";
                    if ($pick === 1) {
                        $cx = $x + 60; $cy = $y + 52;
                        $tiles .= "\n    <circle cx=\"{$cx}\" cy=\"{$cy}\" r=\"16\" fill=\"{$a2}\" opacity=\".8\"/>";
                    }
                }
            }
            $body .= <<<SVG
  <g filter="url(#{$uid}sh)">
    <!-- telefon sa feed-om -->
    <g transform="translate(150 90)">
      <rect x="0" y="0" width="330" height="580" rx="46" fill="#160f30" stroke="#ffffff" stroke-opacity=".18"/>
      <rect x="12" y="12" width="306" height="556" rx="38" fill="url(#{$uid}panel)"/>
      <rect x="126" y="30" width="80" height="10" rx="5" fill="#ffffff" fill-opacity=".2"/>
      <!-- story krugovi -->
      <circle cx="58" cy="90" r="22" fill="none" stroke="url(#{$uid}acc)" stroke-width="3"/>
      <circle cx="58" cy="90" r="16" fill="{$a1}" opacity=".7"/>
      <circle cx="118" cy="90" r="22" fill="none" stroke="url(#{$uid}acc)" stroke-width="3"/>
      <circle cx="118" cy="90" r="16" fill="{$a2}" opacity=".6"/>
      <circle cx="178" cy="90" r="22" fill="none" stroke="#ffffff" stroke-opacity=".25" stroke-width="3"/>
      <circle cx="178" cy="90" r="16" fill="#abbbe5" opacity=".5"/>
      <circle cx="238" cy="90" r="22" fill="none" stroke="#ffffff" stroke-opacity=".18" stroke-width="3"/>
      <circle cx="238" cy="90" r="16" fill="#ffffff" fill-opacity=".12"/>
      <!-- post -->
      <circle cx="52" cy="164" r="16" fill="url(#{$uid}acc)"/>
      <rect x="78" y="156" width="90" height="9" rx="4.5" fill="#ffffff" fill-opacity=".24"/>
      <rect x="78" y="171" width="54" height="7" rx="3.5" fill="#ffffff" fill-opacity=".12"/>
      <rect x="36" y="196" width="258" height="230" rx="18" fill="url(#{$uid}deep)" stroke="#ffffff" stroke-opacity=".1"/>
      <circle cx="106" cy="266" r="30" fill="{$a2}" opacity=".85"/>
      <path d="M52 402l70-62 52 42 40-32 66 52H52z" fill="{$a1}" opacity=".5"/>
      <!-- akcije -->
      <path d="M44 452c0-8 6-14 14-14 5 0 9 3 11 6 2-3 6-6 11-6 8 0 14 6 14 14 0 12-16 20-25 27-9-7-25-15-25-27z" fill="{$a1}"/>
      <circle cx="120" cy="459" r="10" fill="none" stroke="#ffffff" stroke-opacity=".4" stroke-width="2.5"/>
      <path d="M152 450h20l-6 18-14-6z" fill="#ffffff" fill-opacity=".4"/>
      <rect x="36" y="486" width="170" height="9" rx="4.5" fill="#ffffff" fill-opacity=".2"/>
      <rect x="36" y="504" width="230" height="9" rx="4.5" fill="#ffffff" fill-opacity=".12"/>
      <rect x="36" y="522" width="140" height="9" rx="4.5" fill="{$a1}" fill-opacity=".45"/>
    </g>

    <!-- grid profila -->
    <rect x="660" y="130" width="440" height="480" rx="24" fill="url(#{$uid}panel)" stroke="#ffffff" stroke-opacity=".14"/>
    <circle cx="726" cy="196" r="30" fill="url(#{$uid}acc)"/>
    <rect x="770" y="180" width="120" height="12" rx="6" fill="#ffffff" fill-opacity=".26"/>
    <rect x="770" y="200" width="80" height="9" rx="4.5" fill="#ffffff" fill-opacity=".14"/>
    <rect x="940" y="182" width="120" height="30" rx="15" fill="url(#{$uid}acc)"/>
    <rect x="700" y="248" width="60" height="9" rx="4.5" fill="{$a1}" fill-opacity=".7"/>
    <rect x="790" y="248" width="60" height="9" rx="4.5" fill="#ffffff" fill-opacity=".14"/>
    <rect x="880" y="248" width="60" height="9" rx="4.5" fill="#ffffff" fill-opacity=".14"/>
    {$tiles}
  </g>
SVG;
            break;
        }

        /* ---------- REZERVACIJE: kalendar + panel ---------- */
        case 'booking': {
            $cells = '';
            for ($r = 0; $r < 5; $r++) {
                for ($c = 0; $c < 7; $c++) {
                    $x = 180 + $c * 74;
                    $y = 300 + $r * 66;
                    $pick = vug_art_rand($st, 0, 5);
                    if ($pick === 0)      { $fill = "url(#{$uid}acc)"; $op = '.9'; }
                    elseif ($pick === 1)  { $fill = $a1; $op = '.35'; }
                    elseif ($pick === 2)  { $fill = '#ffffff'; $op = '.05'; }
                    else                  { $fill = '#ffffff'; $op = '.03'; }
                    $cells .= "\n    <rect x=\"{$x}\" y=\"{$y}\" width=\"60\" height=\"52\" rx=\"12\" fill=\"{$fill}\" opacity=\"{$op}\"/>";
                    if ($pick === 0) {
                        $lx = $x + 12; $ly = $y + 20;
                        $cells .= "\n    <rect x=\"{$lx}\" y=\"{$ly}\" width=\"34\" height=\"7\" rx=\"3.5\" fill=\"#160f30\" fill-opacity=\".55\"/>";
                        $ly2 = $y + 32;
                        $cells .= "\n    <rect x=\"{$lx}\" y=\"{$ly2}\" width=\"22\" height=\"6\" rx=\"3\" fill=\"#160f30\" fill-opacity=\".35\"/>";
                    }
                }
            }
            $body .= <<<SVG
  <g filter="url(#{$uid}sh)">
    <rect x="110" y="100" width="720" height="560" rx="26" fill="url(#{$uid}panel)" stroke="#ffffff" stroke-opacity=".14"/>
    <rect x="150" y="140" width="200" height="18" rx="9" fill="#ffffff" fill-opacity=".26"/>
    <rect x="150" y="170" width="130" height="9" rx="4.5" fill="{$a1}" fill-opacity=".6"/>
    <rect x="640" y="138" width="150" height="34" rx="17" fill="url(#{$uid}acc)"/>
    <rect x="150" y="212" width="640" height="1" fill="#ffffff" fill-opacity=".12"/>
SVG;
            for ($c = 0; $c < 7; $c++) {
                $x = 192 + $c * 74;
                $body .= "\n    <rect x=\"{$x}\" y=\"250\" width=\"34\" height=\"8\" rx=\"4\" fill=\"#ffffff\" fill-opacity=\".18\"/>";
            }
            $body .= $cells;
            $body .= <<<SVG

    <!-- bočni panel: potvrda rezervacije -->
    <g transform="translate(790 190)">
      <rect x="0" y="0" width="310" height="380" rx="22" fill="#1c1338" stroke="{$a1}" stroke-opacity=".35"/>
      <rect x="26" y="30" width="120" height="14" rx="7" fill="url(#{$uid}acc)"/>
      <rect x="26" y="58" width="200" height="9" rx="4.5" fill="#ffffff" fill-opacity=".18"/>
      <rect x="26" y="96" width="258" height="54" rx="14" fill="#ffffff" fill-opacity=".05"/>
      <circle cx="56" cy="123" r="14" fill="{$a1}" opacity=".8"/>
      <rect x="82" y="112" width="110" height="9" rx="4.5" fill="#ffffff" fill-opacity=".22"/>
      <rect x="82" y="128" width="70" height="8" rx="4" fill="#ffffff" fill-opacity=".12"/>
      <rect x="26" y="166" width="258" height="54" rx="14" fill="#ffffff" fill-opacity=".05"/>
      <circle cx="56" cy="193" r="14" fill="{$a2}" opacity=".8"/>
      <rect x="82" y="182" width="130" height="9" rx="4.5" fill="#ffffff" fill-opacity=".22"/>
      <rect x="82" y="198" width="84" height="8" rx="4" fill="#ffffff" fill-opacity=".12"/>
      <rect x="26" y="240" width="258" height="1" fill="#ffffff" fill-opacity=".12"/>
      <rect x="26" y="262" width="90" height="12" rx="6" fill="#ffffff" fill-opacity=".2"/>
      <rect x="204" y="260" width="80" height="16" rx="8" fill="{$a2}"/>
      <rect x="26" y="304" width="258" height="46" rx="23" fill="url(#{$uid}acc)"/>
      <path d="M132 322l8 9 16-17" stroke="#160f30" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    </g>
  </g>
SVG;
            break;
        }

        /* ---------- E-COMMERCE: proizvodi + korpa ---------- */
        case 'shop': {
            $prod = '';
            for ($i = 0; $i < 6; $i++) {
                $x = 170 + ($i % 3) * 218;
                $y = 300 + intdiv($i, 3) * 190;
                $tone = $i % 3 === 0 ? "url(#{$uid}acc)" : ($i % 3 === 1 ? "url(#{$uid}deep)" : $a1);
                $op = $i % 3 === 2 ? '.5' : '.95';
                $prod .= <<<SVG

    <rect x="{$x}" y="{$y}" width="196" height="168" rx="18" fill="#ffffff" fill-opacity=".05" stroke="#ffffff" stroke-opacity=".1"/>
SVG;
                $ix = $x + 16; $iy = $y + 16;
                $prod .= "\n    <rect x=\"{$ix}\" y=\"{$iy}\" width=\"164\" height=\"90\" rx=\"12\" fill=\"{$tone}\" opacity=\"{$op}\"/>";
                $tx = $x + 16; $ty = $y + 118;
                $prod .= "\n    <rect x=\"{$tx}\" y=\"{$ty}\" width=\"104\" height=\"9\" rx=\"4.5\" fill=\"#ffffff\" fill-opacity=\".2\"/>";
                $ty2 = $y + 136;
                $prod .= "\n    <rect x=\"{$tx}\" y=\"{$ty2}\" width=\"56\" height=\"12\" rx=\"6\" fill=\"{$a2}\" fill-opacity=\".85\"/>";
                $bx = $x + 150; $by = $y + 128;
                $prod .= "\n    <rect x=\"{$bx}\" y=\"{$by}\" width=\"30\" height=\"26\" rx=\"9\" fill=\"{$a1}\" fill-opacity=\".3\"/>";
            }
            $body .= <<<SVG
  <g filter="url(#{$uid}sh)">
    <rect x="110" y="90" width="800" height="600" rx="24" fill="url(#{$uid}panel)" stroke="#ffffff" stroke-opacity=".14"/>
    <path d="M110 114a24 24 0 0 1 24-24h752a24 24 0 0 1 24 24v40H110z" fill="#2b1f52"/>
    <circle cx="146" cy="122" r="6" fill="{$a1}"/><circle cx="168" cy="122" r="6" fill="{$a2}"/><circle cx="190" cy="122" r="6" fill="#abbbe5"/>
    <rect x="230" y="112" width="440" height="20" rx="10" fill="#ffffff" fill-opacity=".07"/>
    <rect x="150" y="186" width="200" height="20" rx="10" fill="url(#{$uid}acc)"/>
    <rect x="150" y="220" width="280" height="10" rx="5" fill="#ffffff" fill-opacity=".16"/>
    <rect x="620" y="184" width="120" height="30" rx="15" fill="#ffffff" fill-opacity=".06"/>
    <rect x="756" y="184" width="120" height="30" rx="15" fill="url(#{$uid}acc)" fill-opacity=".9"/>
    <rect x="150" y="258" width="60" height="8" rx="4" fill="{$a1}" fill-opacity=".7"/>
    <rect x="230" y="258" width="60" height="8" rx="4" fill="#ffffff" fill-opacity=".14"/>
    <rect x="310" y="258" width="60" height="8" rx="4" fill="#ffffff" fill-opacity=".14"/>
    {$prod}

    <!-- korpa -->
    <g transform="translate(830 210)">
      <rect x="0" y="0" width="290" height="330" rx="22" fill="#1c1338" stroke="{$a1}" stroke-opacity=".35"/>
      <rect x="26" y="28" width="110" height="14" rx="7" fill="url(#{$uid}acc)"/>
      <rect x="26" y="70" width="238" height="56" rx="14" fill="#ffffff" fill-opacity=".05"/>
      <rect x="40" y="82" width="32" height="32" rx="10" fill="{$a1}" opacity=".8"/>
      <rect x="86" y="86" width="100" height="9" rx="4.5" fill="#ffffff" fill-opacity=".22"/>
      <rect x="86" y="102" width="48" height="8" rx="4" fill="{$a2}" fill-opacity=".7"/>
      <rect x="26" y="140" width="238" height="56" rx="14" fill="#ffffff" fill-opacity=".05"/>
      <rect x="40" y="152" width="32" height="32" rx="10" fill="{$a2}" opacity=".8"/>
      <rect x="86" y="156" width="80" height="9" rx="4.5" fill="#ffffff" fill-opacity=".22"/>
      <rect x="86" y="172" width="48" height="8" rx="4" fill="{$a2}" fill-opacity=".7"/>
      <rect x="26" y="216" width="238" height="1" fill="#ffffff" fill-opacity=".12"/>
      <rect x="26" y="234" width="70" height="12" rx="6" fill="#ffffff" fill-opacity=".2"/>
      <rect x="184" y="232" width="80" height="16" rx="8" fill="{$a2}"/>
      <rect x="26" y="270" width="238" height="42" rx="21" fill="url(#{$uid}acc)"/>
    </g>
  </g>
SVG;
            break;
        }

        /* ---------- BREND: logo + tipografija + paleta ---------- */
        case 'brand':
        default: {
            $sw = '';
            $tones = [$a1, $a2, '#abbbe5', '#4f4698', '#5d54b8'];
            foreach ($tones as $i => $tn) {
                $x = 170 + $i * 96;
                $sw .= "\n    <circle cx=\"" . ($x + 34) . "\" cy=\"594\" r=\"34\" fill=\"{$tn}\"/>";
            }
            $body .= <<<SVG
  <g filter="url(#{$uid}sh)">
    <rect x="120" y="100" width="470" height="330" rx="24" fill="url(#{$uid}panel)" stroke="#ffffff" stroke-opacity=".14"/>
    <g transform="translate(250 190)">
      <rect x="0" y="0" width="86" height="86" rx="26" fill="url(#{$uid}acc)"/>
      <path d="M22 26l21 44 21-44" stroke="#160f30" stroke-width="9" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      <rect x="112" y="18" width="94" height="20" rx="10" fill="#ffffff" fill-opacity=".28"/>
      <rect x="112" y="48" width="140" height="10" rx="5" fill="#ffffff" fill-opacity=".14"/>
    </g>
    <rect x="160" y="360" width="180" height="10" rx="5" fill="{$a1}" fill-opacity=".55"/>

    <rect x="620" y="100" width="470" height="330" rx="24" fill="#1c1338" stroke="#ffffff" stroke-opacity=".14"/>
    <rect x="660" y="146" width="330" height="42" rx="12" fill="url(#{$uid}acc)" opacity=".9"/>
    <rect x="660" y="204" width="270" height="20" rx="10" fill="#ffffff" fill-opacity=".24"/>
    <rect x="660" y="238" width="380" height="12" rx="6" fill="#ffffff" fill-opacity=".14"/>
    <rect x="660" y="262" width="340" height="12" rx="6" fill="#ffffff" fill-opacity=".1"/>
    <rect x="660" y="286" width="360" height="12" rx="6" fill="#ffffff" fill-opacity=".08"/>
    <rect x="660" y="330" width="120" height="34" rx="17" fill="{$a1}" fill-opacity=".25"/>
    <rect x="794" y="330" width="120" height="34" rx="17" fill="{$a2}" fill-opacity=".2"/>

    <rect x="120" y="470" width="970" height="190" rx="24" fill="url(#{$uid}panel)" stroke="#ffffff" stroke-opacity=".14"/>
    <rect x="160" y="506" width="150" height="12" rx="6" fill="#ffffff" fill-opacity=".2"/>
    {$sw}
    <rect x="700" y="540" width="350" height="90" rx="18" fill="url(#{$uid}deep)" stroke="#ffffff" stroke-opacity=".1"/>
    <rect x="726" y="566" width="120" height="12" rx="6" fill="{$a2}"/>
    <rect x="726" y="590" width="200" height="9" rx="4.5" fill="#ffffff" fill-opacity=".18"/>
  </g>
SVG;
            break;
        }
    }

    $altEsc = htmlspecialchars($alt, ENT_QUOTES, 'UTF-8');

    return "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 {$W} {$H}\" width=\"{$W}\" height=\"{$H}\""
         . " role=\"img\" aria-label=\"{$altEsc}\" fill=\"none\">\n"
         . "  <title>{$altEsc}</title>\n"
         . $defs . "\n"
         . "  <g clip-path=\"url(#{$uid}clip)\">\n"
         . $bg . "\n"
         . $body . "\n"
         . "  </g>\n"
         . "</svg>\n";
}

/* ==========================================================================
   SOCIAL PROJEKTI - vizuali u formatima u kojima sadržaj zaista živi.
   Stranica /projekti/<slug> za vođenje mreža ne prikazuje "sajt na ekranu",
   pa uz 16:10 prikaze dobija:
     vug_art_grid_svg()     -> 900x900, mreža profila 3x3 (jedan zahtev, ne 9)
     vug_art_vertical_svg() -> 720x1280 (9:16), reel / story / carousel
   ========================================================================== */

/** Zajednički <defs> za nove formate (isti gradijenti kao u vug_art_svg). */
function vug_art_defs(string $uid, string $a1, string $a2, int $blur = 40): string {
    return <<<SVG
  <defs>
    <linearGradient id="{$uid}acc" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="{$a1}"/><stop offset="1" stop-color="{$a2}"/>
    </linearGradient>
    <linearGradient id="{$uid}panel" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#241a44"/><stop offset="1" stop-color="#160f30"/>
    </linearGradient>
    <linearGradient id="{$uid}deep" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#4f4698"/><stop offset="1" stop-color="#241a44"/>
    </linearGradient>
    <linearGradient id="{$uid}fade" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0" stop-color="#0d0820" stop-opacity="0"/><stop offset="1" stop-color="#0d0820" stop-opacity=".85"/>
    </linearGradient>
    <filter id="{$uid}blur" x="-50%" y="-50%" width="200%" height="200%">
      <feGaussianBlur stdDeviation="{$blur}"/>
    </filter>
  </defs>
SVG;
}

/**
 * Mreža profila (1:1) - devet pločica kao na Instagram profilu.
 * @param array $o ['a1'=>hex,'a2'=>hex,'seed'=>int,'alt'=>string]
 */
function vug_art_grid_svg(array $o = []): string {
    $a1   = $o['a1']   ?? '#5dd3f5';
    $a2   = $o['a2']   ?? '#cffbf6';
    $seed = (int) ($o['seed'] ?? 7);
    $alt  = $o['alt']  ?? 'Mreža objava';
    $st   = ['s' => ($seed * 2654435761) & 0xFFFFFFFF ?: 12345];

    $S = 900; $gap = 12; $t = 292;                 // 3*292 + 2*12 = 900
    $uid = 'q' . substr(md5('grid' . $seed . $a1), 0, 6);

    $tiles = '';
    for ($r = 0; $r < 3; $r++) {
        for ($c = 0; $c < 3; $c++) {
            $x    = $c * ($t + $gap);
            $y    = $r * ($t + $gap);
            $pick = vug_art_rand($st, 0, 5);
            $tiles .= "\n  <g transform=\"translate({$x} {$y})\">";
            $tiles .= "\n    <rect width=\"{$t}\" height=\"{$t}\" rx=\"16\" fill=\"url(#{$uid}"
                    . ($pick % 2 === 0 ? 'panel' : 'deep') . ")\"/>";

            switch ($pick) {
                case 0: // kadar proizvoda u akcentu
                    $tiles .= "\n    <rect x=\"22\" y=\"22\" width=\"248\" height=\"188\" rx=\"14\" fill=\"url(#{$uid}acc)\" opacity=\".9\"/>"
                            . "\n    <circle cx=\"146\" cy=\"116\" r=\"52\" fill=\"#160f30\" fill-opacity=\".22\"/>"
                            . "\n    <rect x=\"22\" y=\"232\" width=\"170\" height=\"12\" rx=\"6\" fill=\"#ffffff\" fill-opacity=\".2\"/>"
                            . "\n    <rect x=\"22\" y=\"254\" width=\"110\" height=\"12\" rx=\"6\" fill=\"#ffffff\" fill-opacity=\".1\"/>";
                    break;
                case 1: // reel - play bedž
                    $tiles .= "\n    <circle cx=\"146\" cy=\"132\" r=\"84\" fill=\"{$a1}\" opacity=\".28\"/>"
                            . "\n    <circle cx=\"146\" cy=\"132\" r=\"46\" fill=\"{$a2}\" opacity=\".95\"/>"
                            . "\n    <path d=\"M134 110l34 22-34 22z\" fill=\"#160f30\"/>"
                            . "\n    <rect x=\"22\" y=\"236\" width=\"140\" height=\"12\" rx=\"6\" fill=\"#ffffff\" fill-opacity=\".2\"/>"
                            . "\n    <rect x=\"236\" y=\"22\" width=\"34\" height=\"34\" rx=\"11\" fill=\"{$a2}\" fill-opacity=\".22\"/>";
                    break;
                case 2: // citat / tekstualna objava
                    $tiles .= "\n    <rect x=\"22\" y=\"22\" width=\"248\" height=\"248\" rx=\"14\" fill=\"{$a1}\" opacity=\".8\"/>"
                            . "\n    <rect x=\"48\" y=\"92\" width=\"196\" height=\"18\" rx=\"9\" fill=\"#160f30\" fill-opacity=\".35\"/>"
                            . "\n    <rect x=\"48\" y=\"124\" width=\"150\" height=\"18\" rx=\"9\" fill=\"#160f30\" fill-opacity=\".28\"/>"
                            . "\n    <rect x=\"48\" y=\"156\" width=\"176\" height=\"18\" rx=\"9\" fill=\"#160f30\" fill-opacity=\".2\"/>"
                            . "\n    <circle cx=\"58\" cy=\"216\" r=\"12\" fill=\"#160f30\" fill-opacity=\".3\"/>";
                    break;
                case 3: // rezultat / mali grafikon
                    $bars = '';
                    for ($i = 0; $i < 5; $i++) {
                        $h  = vug_art_rand($st, 44, 150);
                        $bx = 40 + $i * 46;
                        $by = 232 - $h;
                        $fl = $i % 2 === 0 ? $a2 : $a1;
                        $bars .= "\n    <rect x=\"{$bx}\" y=\"{$by}\" width=\"28\" height=\"{$h}\" rx=\"10\" fill=\"{$fl}\" opacity=\".85\"/>";
                    }
                    $tiles .= "\n    <rect x=\"22\" y=\"22\" width=\"248\" height=\"248\" rx=\"14\" fill=\"#ffffff\" fill-opacity=\".04\"/>"
                            . $bars
                            . "\n    <rect x=\"40\" y=\"248\" width=\"120\" height=\"10\" rx=\"5\" fill=\"#ffffff\" fill-opacity=\".16\"/>";
                    break;
                case 4: // portret / lice brenda
                    $tiles .= "\n    <circle cx=\"146\" cy=\"116\" r=\"56\" fill=\"{$a2}\" opacity=\".9\"/>"
                            . "\n    <path d=\"M42 292c0-58 47-96 104-96s104 38 104 96z\" fill=\"{$a1}\" opacity=\".55\"/>"
                            . "\n    <rect x=\"22\" y=\"22\" width=\"96\" height=\"12\" rx=\"6\" fill=\"#ffffff\" fill-opacity=\".18\"/>";
                    break;
                default: // karusel - pločice u nizu + tačkice
                    $tiles .= "\n    <rect x=\"22\" y=\"36\" width=\"200\" height=\"172\" rx=\"14\" fill=\"url(#{$uid}acc)\" opacity=\".85\"/>"
                            . "\n    <rect x=\"234\" y=\"56\" width=\"56\" height=\"132\" rx=\"14\" fill=\"#ffffff\" fill-opacity=\".08\"/>"
                            . "\n    <rect x=\"48\" y=\"152\" width=\"120\" height=\"14\" rx=\"7\" fill=\"#160f30\" fill-opacity=\".3\"/>"
                            . "\n    <circle cx=\"124\" cy=\"244\" r=\"7\" fill=\"{$a2}\"/>"
                            . "\n    <circle cx=\"148\" cy=\"244\" r=\"7\" fill=\"#ffffff\" fill-opacity=\".25\"/>"
                            . "\n    <circle cx=\"172\" cy=\"244\" r=\"7\" fill=\"#ffffff\" fill-opacity=\".25\"/>";
                    break;
            }
            $tiles .= "\n  </g>";
        }
    }

    $altEsc = htmlspecialchars($alt, ENT_QUOTES, 'UTF-8');
    return "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 {$S} {$S}\" width=\"{$S}\" height=\"{$S}\""
         . " role=\"img\" aria-label=\"{$altEsc}\" fill=\"none\">\n"
         . "  <title>{$altEsc}</title>\n"
         . vug_art_defs($uid, $a1, $a2, 90) . "\n"
         . "  <rect width=\"{$S}\" height=\"{$S}\" fill=\"#120c28\"/>\n"
         . $tiles . "\n"
         . "</svg>\n";
}

/**
 * Vertikalni prikaz 9:16 - format u kome sadržaj za mreže i nastaje.
 * @param string $kind reel|story|carousel
 * @param array  $o    ['a1'=>hex,'a2'=>hex,'seed'=>int,'alt'=>string]
 */
function vug_art_vertical_svg(string $kind, array $o = []): string {
    $a1   = $o['a1']   ?? '#5dd3f5';
    $a2   = $o['a2']   ?? '#cffbf6';
    $seed = (int) ($o['seed'] ?? 7);
    $alt  = $o['alt']  ?? 'Vertikalni sadržaj';
    $st   = ['s' => ($seed * 2654435761) & 0xFFFFFFFF ?: 12345];

    $W = 720; $H = 1280;
    $uid = 'v' . substr(md5($kind . $seed . $a1), 0, 6);

    // Pozadina: kadar (blob-ovi u akcentu) + zatamnjenje ka dnu, da tekst "leži"
    $bx = vug_art_rand($st, 140, 580);
    $by = vug_art_rand($st, 220, 700);
    $bg = <<<SVG
  <rect width="{$W}" height="{$H}" fill="#120c28"/>
  <g filter="url(#{$uid}blur)" opacity=".95">
    <circle cx="{$bx}" cy="{$by}" r="300" fill="{$a1}" opacity=".5"/>
    <circle cx="360" cy="1060" r="260" fill="{$a2}" opacity=".22"/>
    <circle cx="200" cy="300" r="220" fill="#4f4698" opacity=".6"/>
  </g>
SVG;

    $body = '';

    switch ($kind) {

        /* ---------- STORY: trake napretka, nalog, anketa, swipe-up ---------- */
        case 'story': {
            $segs = '';
            for ($i = 0; $i < 4; $i++) {
                $sx = 40 + $i * 165;
                $op = $i === 1 ? '.95' : '.28';
                $segs .= "\n  <rect x=\"{$sx}\" y=\"52\" width=\"150\" height=\"6\" rx=\"3\" fill=\"#ffffff\" fill-opacity=\"{$op}\"/>";
            }
            $body = $segs . <<<SVG

  <circle cx="72" cy="112" r="26" fill="url(#{$uid}acc)"/>
  <rect x="112" y="100" width="150" height="14" rx="7" fill="#ffffff" fill-opacity=".28"/>
  <rect x="112" y="122" width="90" height="10" rx="5" fill="#ffffff" fill-opacity=".14"/>

  <!-- anketa / sticker -->
  <rect x="72" y="470" width="576" height="240" rx="30" fill="#160f30" fill-opacity=".72" stroke="#ffffff" stroke-opacity=".16"/>
  <rect x="112" y="512" width="300" height="20" rx="10" fill="#ffffff" fill-opacity=".3"/>
  <rect x="112" y="566" width="496" height="54" rx="18" fill="url(#{$uid}acc)"/>
  <rect x="112" y="634" width="496" height="54" rx="18" fill="#ffffff" fill-opacity=".1"/>

  <!-- swipe up -->
  <rect x="220" y="1108" width="280" height="62" rx="31" fill="{$a2}"/>
  <path d="M348 1152l12-16 12 16" stroke="#160f30" stroke-width="6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
  <rect x="252" y="1126" width="80" height="14" rx="7" fill="#160f30" fill-opacity=".55"/>
SVG;
            break;
        }

        /* ---------- CARUSEL: složene kartice + tačkice ---------- */
        case 'carousel': {
            $rows = '';
            for ($i = 0; $i < 3; $i++) {
                $ry = 720 + $i * 96;
                $rw = vug_art_rand($st, 240, 460);
                $rows .= "\n  <rect x=\"88\" y=\"{$ry}\" width=\"544\" height=\"72\" rx=\"20\" fill=\"#ffffff\" fill-opacity=\".06\"/>";
                $rows .= "\n  <circle cx=\"128\" cy=\"" . ($ry + 36) . "\" r=\"16\" fill=\"" . ($i % 2 ? $a2 : $a1) . "\" opacity=\".85\"/>";
                $rows .= "\n  <rect x=\"160\" y=\"" . ($ry + 29) . "\" width=\"{$rw}\" height=\"14\" rx=\"7\" fill=\"#ffffff\" fill-opacity=\".2\"/>";
            }
            $body = <<<SVG
  <rect x="60" y="120" width="600" height="540" rx="34" fill="url(#{$uid}acc)" opacity=".92"/>
  <circle cx="360" cy="356" r="118" fill="#160f30" fill-opacity=".2"/>
  <rect x="112" y="176" width="180" height="18" rx="9" fill="#160f30" fill-opacity=".3"/>
  <rect x="688" y="180" width="26" height="420" rx="13" fill="#ffffff" fill-opacity=".1"/>
  <rect x="112" y="556" width="300" height="24" rx="12" fill="#160f30" fill-opacity=".32"/>
{$rows}

  <!-- tačkice karusela -->
  <circle cx="312" cy="1152" r="9" fill="{$a2}"/>
  <circle cx="344" cy="1152" r="9" fill="#ffffff" fill-opacity=".28"/>
  <circle cx="376" cy="1152" r="9" fill="#ffffff" fill-opacity=".28"/>
  <circle cx="408" cy="1152" r="9" fill="#ffffff" fill-opacity=".28"/>
SVG;
            break;
        }

        /* ---------- REEL: play u sredini, bočne akcije, opis pri dnu ---------- */
        case 'reel':
        default: {
            $body = <<<SVG
  <!-- subjekat kadra -->
  <circle cx="300" cy="470" r="150" fill="{$a2}" opacity=".85"/>
  <path d="M60 860l210-190 150 116 112-92 188 166v40H60z" fill="{$a1}" opacity=".5"/>

  <!-- play -->
  <circle cx="360" cy="640" r="82" fill="#160f30" fill-opacity=".45" stroke="#ffffff" stroke-opacity=".3" stroke-width="2"/>
  <path d="M336 602l64 38-64 38z" fill="#ffffff"/>

  <!-- gornji red: nalog + trajanje -->
  <circle cx="72" cy="96" r="26" fill="url(#{$uid}acc)"/>
  <rect x="112" y="84" width="160" height="14" rx="7" fill="#ffffff" fill-opacity=".28"/>
  <rect x="112" y="106" width="96" height="10" rx="5" fill="#ffffff" fill-opacity=".14"/>
  <rect x="576" y="80" width="88" height="32" rx="16" fill="#160f30" fill-opacity=".55"/>
  <rect x="596" y="91" width="48" height="10" rx="5" fill="#ffffff" fill-opacity=".4"/>

  <!-- bočne akcije: srce, komentar, deljenje -->
  <path d="M660 946c-16-12-30-24-30-38a18 18 0 0 1 30-13 18 18 0 0 1 30 13c0 14-14 26-30 38z" fill="{$a2}" opacity=".9"/>
  <circle cx="660" cy="1000" r="24" fill="none" stroke="#ffffff" stroke-opacity=".5" stroke-width="5"/>
  <path d="M636 1084h48l-14 44-34-14z" fill="#ffffff" fill-opacity=".5"/>

  <!-- zatamnjenje + opis -->
  <rect x="0" y="880" width="{$W}" height="400" fill="url(#{$uid}fade)"/>
  <rect x="60" y="1052" width="420" height="20" rx="10" fill="#ffffff" fill-opacity=".28"/>
  <rect x="60" y="1088" width="520" height="16" rx="8" fill="#ffffff" fill-opacity=".16"/>
  <rect x="60" y="1120" width="300" height="16" rx="8" fill="{$a1}" fill-opacity=".55"/>
  <rect x="60" y="1176" width="180" height="44" rx="22" fill="{$a2}"/>
SVG;
            break;
        }
    }

    $altEsc = htmlspecialchars($alt, ENT_QUOTES, 'UTF-8');
    return "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 {$W} {$H}\" width=\"{$W}\" height=\"{$H}\""
         . " role=\"img\" aria-label=\"{$altEsc}\" fill=\"none\">\n"
         . "  <title>{$altEsc}</title>\n"
         . vug_art_defs($uid, $a1, $a2, 70) . "\n"
         . $bg . "\n"
         . $body . "\n"
         . "</svg>\n";
}

}
