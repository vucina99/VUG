<?php
/**
 * Deljeni <head> — jedinstven za SVE stranice. Emituje <!DOCTYPE>, <html>,
 * kompletan <head> (meta/SEO/OG/Twitter/favicon/fontovi/JSON-LD) i otvara <body>.
 *
 * Zahteva (definisati PRE require-a):
 *   $lang              — 'sr' | 'en'
 *   $t                 — jezički niz (lang/*.php)
 *   $base              — bazna putanja bez / na kraju
 *   $meta_title        — <title> + og:title
 *   $meta_description  — meta description + og:description
 *   $canonical         — apsolutni canonical URL
 *
 * Opciono:
 *   $SITE_URL          [default 'https://vugagency.com']
 *   $meta_keywords     [default '']  — izostavlja se ako je prazno
 *   $robots            [default 'index, follow, max-image-preview:large, max-snippet:-1']
 *   $alt_links         [default []]  — niz ['hreflang'=>..., 'href'=>...] za hreflang alternate
 *   $og_image          [default $SITE_URL/img/og-image.png]
 *   $og_type           [default 'website']
 *   $og_image_alt      [default 'VUG — Digitalna agencija' / 'Digital Agency']
 *   $geo_region        — npr. 'RS-14' (izostavlja se ako nije zadato)
 *   $geo_placename     — npr. 'Pančevo'
 *   $json_ld           — PHP niz koji se serijalizuje u <script type="application/ld+json">
 *   $extra_head        — sirovi HTML za stranicu (page-specific <style>/<link>)
 */
$SITE_URL      = $SITE_URL      ?? 'https://vugagency.com';
$meta_keywords = $meta_keywords ?? '';
$robots        = $robots        ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
$alt_links     = $alt_links     ?? [];
$og_image      = $og_image      ?? ($SITE_URL . '/img/og-image.png');
$og_type       = $og_type       ?? 'website';
$json_ld       = $json_ld       ?? null;
$extra_head    = $extra_head    ?? '';
$is_sr         = (($lang ?? 'sr') === 'sr');
$og_image_alt  = $og_image_alt  ?? ('VUG — ' . ($is_sr ? 'Digitalna agencija' : 'Digital Agency'));
$css_v         = @filemtime(dirname(__DIR__) . '/css/style.css');
$GA_ID         = 'G-W07YT5991W';

/* Critical CSS (nav + hero) se ubacuje INLINE, pa prvi ekran nema ni jedan
   blokirajući zahtev; ostatak (css/style.css) se učitava non-blocking.
   Lagana minifikacija u letu — nema build stepa, a ~22 KB izvora se svede
   na ~17 KB u HTML-u (uz gzip razlika je mala, ali je parsiranje brže). */
$critical_css = (string) @file_get_contents(dirname(__DIR__) . '/css/critical.css');
$critical_css = preg_replace('#/\*.*?\*/#s', '', $critical_css);
$critical_css = trim(preg_replace('/\s+/', ' ', (string) $critical_css));
/* VAŽNO: u inline <style> relativne putanje se razrešavaju prema URL-u
   STRANICE, ne prema css/ folderu — zato '../fonts/' mora u apsolutnu putanju.
   Ovako je identična <link rel="preload"> URL-u ispod, pa preload zaista
   pokrije font i nema dvostrukog preuzimanja. */
$critical_css = str_replace('../fonts/', $base . '/fonts/', $critical_css);
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($t['lang_code']) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d0820">

    <title><?= htmlspecialchars($meta_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
<?php if ($meta_keywords !== ''): ?>
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
<?php endif; ?>
    <meta name="author" content="VUG">
    <meta name="publisher" content="VUG">
    <meta name="robots" content="<?= htmlspecialchars($robots) ?>">
    <meta name="format-detection" content="telephone=no">
<?php if (!empty($geo_region)): ?>
    <meta name="geo.region" content="<?= htmlspecialchars($geo_region) ?>">
<?php endif; ?>
<?php if (!empty($geo_placename)): ?>
    <meta name="geo.placename" content="<?= htmlspecialchars($geo_placename) ?>">
<?php endif; ?>

    <!-- Canonical + hreflang -->
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
<?php foreach ($alt_links as $alt): ?>
    <link rel="alternate" hreflang="<?= htmlspecialchars($alt['hreflang']) ?>" href="<?= htmlspecialchars($alt['href']) ?>">
<?php endforeach; ?>

    <!-- Open Graph -->
    <meta property="og:type" content="<?= htmlspecialchars($og_type) ?>">
    <meta property="og:locale" content="<?= $is_sr ? 'sr_RS' : 'en_US' ?>">
    <meta property="og:locale:alternate" content="<?= $is_sr ? 'en_US' : 'sr_RS' ?>">
    <meta property="og:site_name" content="VUG">
    <meta property="og:title" content="<?= htmlspecialchars($meta_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($og_image) ?>">
    <meta property="og:image:secure_url" content="<?= htmlspecialchars($og_image) ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?= htmlspecialchars($og_image_alt) ?>">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($meta_title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($og_image) ?>">
    <meta name="twitter:image:alt" content="<?= htmlspecialchars($og_image_alt) ?>">

    <!-- Favicon / PWA -->
    <link rel="icon" href="<?= $base ?>/favicon.ico" sizes="any">
    <link rel="icon" type="image/svg+xml" href="<?= $base ?>/img/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $base ?>/img/icon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $base ?>/img/icon-16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $base ?>/img/apple-touch-icon.png">
    <link rel="manifest" href="<?= $base ?>/site.webmanifest">
    <meta name="application-name" content="VUG">
    <meta name="apple-mobile-web-app-title" content="VUG">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Preload loga u navigaciji -->
    <link rel="preload" as="image" href="<?= $base ?>/img/logoes/logo-blue-white-c-2x.png">
<?php if ($json_ld !== null): ?>
    <script type="application/ld+json">
<?= json_encode($json_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>
<?php endif; ?>

    <!-- Kritičan font (self-hosted, isti origin) -->
    <link rel="preload" as="font" type="font/woff2" href="<?= $base ?>/fonts/plus-jakarta-sans-normal-latin.woff2" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="<?= $base ?>/fonts/plus-jakarta-sans-normal-latin-ext.woff2" crossorigin>

    <!-- Critical CSS (above-the-fold: nav + hero) — inline, bez blokirajućeg
         zahteva. Izvor je css/critical.css; ne pisati stilove direktno ovde. -->
    <style><?= $critical_css ?></style>

    <!-- Google Analytics — gtag.js se učitava LENJO (posle load-a ili na prvu
         interakciju), pa ne troši propusni opseg na putu do prvog iscrtavanja.
         dataLayer je queue: gtag() pozivi ispod se izvrše kad biblioteka stigne. -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?= $GA_ID ?>');
        (function () {
            var done = false;
            function load() {
                if (done) return;
                done = true;
                var s = document.createElement('script');
                s.async = true;
                s.src = 'https://www.googletagmanager.com/gtag/js?id=<?= $GA_ID ?>';
                document.head.appendChild(s);
            }
            function afterLoad() { setTimeout(load, 1000); }
            if (document.readyState === 'complete') afterLoad();
            else window.addEventListener('load', afterLoad, { once: true });
            // Ako korisnik pre toga bilo šta uradi, učitaj odmah.
            ['pointerdown', 'keydown', 'touchstart', 'scroll'].forEach(function (ev) {
                window.addEventListener(ev, load, { once: true, passive: true });
            });
        })();
    </script>

    <!-- Ostatak stilova — NON-BLOCKING: media="print" ne blokira iscrtavanje,
         a onload ga prebaci na "all". <noscript> je fallback bez JS-a.
         Stoji PRE $extra_head, pa stranični <style> blokovi ostaju POSLE njega
         u kaskadi i dalje pobeđuju — isti redosled kao pre razdvajanja CSS-a. -->
    <!-- preload vraća prioritet na High: media="print" resurs Chrome inače
         preuzima sa najnižim prioritetom, pa bi na sporoj vezi sadržaj ispod
         prvog ekrana mogao nakratko da bude bez stilova. -->
    <link rel="preload" as="style" href="<?= $base ?>/css/style.css?v=<?= $css_v ?>">
    <link rel="stylesheet" href="<?= $base ?>/css/style.css?v=<?= $css_v ?>" media="print" onload="this.media='all';this.onload=null">
    <noscript><link rel="stylesheet" href="<?= $base ?>/css/style.css?v=<?= $css_v ?>"></noscript>
<?= $extra_head ?>
</head>
<body data-lang="<?= htmlspecialchars($t['lang_code']) ?>">
