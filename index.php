<?php
$lang = isset($_GET['lang']) && $_GET['lang'] === 'en' ? 'en' : 'sr';
$t = require __DIR__ . '/lang/' . $lang . '.php';
require __DIR__ . '/php/icons.php'; // inline SVG ikonice: vug_icon() + vug_icon_sprite()

// Produkcijski domen — koristi se za canonical, hreflang, OG i JSON-LD.
// (Canonical MORA da pokazuje na produkciju, ne na localhost.)
$SITE_URL   = 'https://vugagency.com';
$url_sr     = $SITE_URL . '/';
$url_en     = $SITE_URL . '/en';
$canonical  = $lang === 'en' ? $url_en : $url_sr;

// ── Cist URL za jezik (/en) ───────────────────────────────────────
// Bazne putanje se racunaju iz lokacije skripte, pa rade i kad je sajt u
// podfolderu (lokal: /VUG digital/) i u rootu (produkcija: /).
$base_path  = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
$href_sr    = $base_path === '' ? '/' : $base_path . '/';   // srpska (default) verzija
$href_en    = $base_path . '/en';                           // engleska verzija
$href_home  = $lang === 'en' ? $href_en : $href_sr;         // trenutni jezik, pocetna
$href_other = $t['lang_other'] === 'en' ? $href_en : $href_sr; // drugi jezik (za toggle)

// Kanonikalizacija URL-a (pre bilo kakvog ispisa):
$req_uri  = $_SERVER['REQUEST_URI'] ?? '';
$req_path = strtok($req_uri, '?');
// 1) Stari ?lang=... -> cist URL (301, izbegava duplikate)
if (strpos($req_uri, 'lang=') !== false) {
    header('Location: ' . $href_home, true, 301);
    exit;
}
// 2) /en/ (sa kosom crtom) -> /en, da relativni asseti (css/js/img) rade ispravno
if (preg_match('#/en/$#', (string)$req_path)) {
    header('Location: ' . $href_en, true, 301);
    exit;
}
$og_image   = $SITE_URL . '/img/og-image.png';

// reCAPTCHA v3 — javni "site key" (sme da bude vidljiv u HTML-u).
// Uzmi ga na https://www.google.com/recaptcha/admin (tip: reCAPTCHA v3).
// Tajni "secret key" ide u php/contact.php, NE ovde.
// Ostavi prazno da isključiš reCAPTCHA (npr. na lokalu bez ključeva).
$RECAPTCHA_SITE_KEY = '6Lfp810tAAAAAMESVTJshdNBip8Vva0aF2IoGWh4';

$other_lang  = $t['lang_other'];
$phone_clean = preg_replace('/\s+/', '', $t['contact_info_phone']);
// Telefon u međunarodnom formatu (E.164) za tel: i schema.org
$phone_intl  = '+381' . ltrim($phone_clean, '0');

// Profili na društvenim mrežama za JSON-LD "sameAs".
// Popuni pravim URL-ovima kad budu poznati (prazan niz = izostavlja se iz scheme).
$social_links = [
    'https://www.instagram.com/vugagency',
    'https://www.facebook.com/profile.php?id=61592111037904',
    'https://www.linkedin.com/company/vug-digital-agency/',
];
?>
<!DOCTYPE html>
<html lang="<?= $t['lang_code'] ?>">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W07YT5991W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-W07YT5991W');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0d0820">

    <title><?= htmlspecialchars($t['meta_title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_description']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($t['meta_keywords']) ?>">
    <meta name="author" content="VUG">
    <meta name="publisher" content="VUG">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="format-detection" content="telephone=no">
    <meta name="geo.region" content="RS-14">
    <meta name="geo.placename" content="Pančevo">

    <!-- Canonical + hreflang (produkcijski domen) -->
    <link rel="canonical" href="<?= $canonical ?>">
    <link rel="alternate" hreflang="sr-RS" href="<?= $url_sr ?>">
    <link rel="alternate" hreflang="en" href="<?= $url_en ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $url_en ?>">

    <!-- Open Graph (Facebook, LinkedIn, Viber, WhatsApp…) -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= $lang === 'sr' ? 'sr_RS' : 'en_US' ?>">
    <meta property="og:locale:alternate" content="<?= $lang === 'sr' ? 'en_US' : 'sr_RS' ?>">
    <meta property="og:site_name" content="VUG">
    <meta property="og:title" content="<?= htmlspecialchars($t['meta_title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($t['meta_description']) ?>">
    <meta property="og:url" content="<?= $canonical ?>">
    <meta property="og:image" content="<?= $og_image ?>">
    <meta property="og:image:secure_url" content="<?= $og_image ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="VUG — <?= $lang === 'sr' ? 'Digitalna agencija' : 'Digital Agency' ?>">

    <!-- Twitter / X -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($t['meta_title']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($t['meta_description']) ?>">
    <meta name="twitter:image" content="<?= $og_image ?>">
    <meta name="twitter:image:alt" content="VUG — <?= $lang === 'sr' ? 'Digitalna agencija' : 'Digital Agency' ?>">

    <!-- Favicon / PWA ikonice -->
    <link rel="icon" href="favicon.ico" sizes="any">
    <link rel="icon" type="image/svg+xml" href="img/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="img/icon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/icon-16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="manifest" href="site.webmanifest">
    <meta name="application-name" content="VUG">
    <meta name="apple-mobile-web-app-title" content="VUG">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Preload loga u navigaciji (vidljiv odmah) -->
    <link rel="preload" as="image" href="img/logoes/logo-blue-white-c.png">

    <!-- Structured data (schema.org @graph): Organization + WebSite + WebPage/FAQPage -->
<?php
$org_id  = $SITE_URL . '/#organization';
$site_id = $SITE_URL . '/#website';

$offers = [];
foreach ([1, 3, 4, 5, 6] as $k) {
    $offers[] = [
        '@type' => 'Offer',
        'itemOffered' => [
            '@type' => 'Service',
            'name' => $t["service_{$k}_title"],
            'description' => $t["service_{$k}_desc"],
        ],
    ];
}

$faq_entities = [];
for ($i = 1; $i <= 10; $i++) {
    $faq_entities[] = [
        '@type' => 'Question',
        'name' => $t["faq_{$i}_q"],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $t["faq_{$i}_a"]],
    ];
}

// Recenzije klijenata — odgovaraju 5★ karticama prikazanim u sekciji #testimonials.
// (Markup MORA da prati sadržaj vidljiv na stranici — svaka recenzija ovde je i renderovana.)
$review_items = [];
for ($i = 1; $i <= 8; $i++) {
    if (empty($t["testimonial_{$i}_quote"])) continue;
    $review_items[] = [
        '@type' => 'Review',
        'author' => ['@type' => 'Person', 'name' => $t["testimonial_{$i}_name"]],
        'reviewRating' => ['@type' => 'Rating', 'ratingValue' => '5', 'bestRating' => '5', 'worstRating' => '1'],
        'reviewBody' => $t["testimonial_{$i}_quote"],
    ];
}

$org = [
    '@type' => ['Organization', 'ProfessionalService'],
    '@id' => $org_id,
    'name' => 'VUG',
    'alternateName' => 'VUG Digital Agency',
    'url' => $SITE_URL . '/',
    'logo' => ['@type' => 'ImageObject', 'url' => $SITE_URL . '/img/icon-512.png', 'width' => 512, 'height' => 512],
    'image' => $og_image,
    'description' => $t['meta_description'],
    'email' => $t['contact_info_email'],
    'telephone' => $phone_intl,
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'contactType' => $lang === 'sr' ? 'Prodaja i podrška' : 'Sales & support',
        'telephone' => $phone_intl,
        'email' => $t['contact_info_email'],
        'availableLanguage' => ['Serbian', 'English'],
        'areaServed' => 'Worldwide',
    ],
    'priceRange' => '$$',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Vojvođanska 12b',
        'addressLocality' => 'Pančevo',
        'postalCode' => '26000',
        'addressRegion' => 'Vojvodina',
        'addressCountry' => 'RS',
    ],
    // Tačne koordinate sedišta (Vojvođanska 12b, Pančevo).
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => '44.8804099',
        'longitude' => '20.6663928',
    ],
    'areaServed' => ['@type' => 'Place', 'name' => 'Worldwide'],
    'openingHoursSpecification' => [
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        'opens' => '00:00',
        'closes' => '23:59',
    ],
    'knowsLanguage' => ['sr', 'en'],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => $lang === 'sr' ? 'Digitalne usluge' : 'Digital services',
        'itemListElement' => $offers,
    ],
];
if (!empty($social_links)) {
    $org['sameAs'] = array_values($social_links);
}
if (!empty($review_items)) {
    $org['review'] = $review_items;
}

$schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        $org,
        [
            '@type' => 'WebSite',
            '@id' => $site_id,
            'url' => $SITE_URL . '/',
            'name' => 'VUG',
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
            'publisher' => ['@id' => $org_id],
        ],
        [
            '@type' => ['WebPage', 'FAQPage'],
            '@id' => $canonical . '#webpage',
            'url' => $canonical,
            'name' => $t['meta_title'],
            'description' => $t['meta_description'],
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
            'isPartOf' => ['@id' => $site_id],
            'about' => ['@id' => $org_id],
            'primaryImageOfPage' => $og_image,
            'dateModified' => date('Y-m-d', @filemtime(__FILE__) ?: time()),
            'mainEntity' => $faq_entities,
        ],
    ],
];
?>
    <script type="application/ld+json">
<?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
    </script>

    <!-- Kritičan font (hero H1 + lead) — self-hosted, isti origin, bez render-blocking Google zahteva -->
    <link rel="preload" as="font" type="font/woff2" href="fonts/plus-jakarta-sans-normal-latin.woff2" crossorigin>
    <link rel="preload" as="font" type="font/woff2" href="fonts/plus-jakarta-sans-normal-latin-ext.woff2" crossorigin>

    <link rel="stylesheet" href="css/style.css?v=<?= @filemtime(__DIR__ . '/css/style.css') ?>">
</head>
<body data-lang="<?= $t['lang_code'] ?>">
<?= vug_icon_sprite() ?>

<a class="skip-link" href="#main"><?= $lang === 'sr' ? 'Pređi na sadržaj' : 'Skip to content' ?></a>

<!-- Gradient mesh BG -->
<div class="mesh" aria-hidden="true"></div>
<div class="grain" aria-hidden="true"></div>

<!-- Custom cursor -->
<div class="cursor" id="cursor" aria-hidden="true"></div>
<div class="cursor-ring" id="cursorRing" aria-hidden="true"></div>

<!-- NAV -->
<nav class="nav" id="nav" aria-label="<?= $lang === 'sr' ? 'Glavna navigacija' : 'Main navigation' ?>">
    <div class="container nav-inner">
        <a href="<?= $href_home ?>" class="brand" aria-label="VUG — <?= $lang === 'sr' ? 'Početna' : 'Home' ?>">
            <img src="img/logoes/logo-blue-white-c.png" alt="VUG Digital Agency" class="brand-logo" width="572" height="120">
        </a>

        <div class="nav-links">
            <a href="#services" class="nav-link"><?= $t['nav_services'] ?></a>
            <a href="#about" class="nav-link"><?= $t['nav_about'] ?></a>
            <a href="#process" class="nav-link"><?= $t['nav_process'] ?></a>
            <a href="#faq" class="nav-link"><?= $t['nav_faq'] ?></a>
            <a href="#references" class="nav-link"><?= $t['nav_references'] ?></a>
            <a href="#contact" class="nav-link"><?= $t['nav_contact'] ?></a>
        </div>

        <div class="nav-actions">
            <a href="<?= $href_other ?>" class="lang-toggle">
                <span class="now"><?= $t['lang_current_label'] ?></span>/<span class="other"><?= $t['lang_other_label'] ?></span>
            </a>
            <a href="#contact" class="btn btn--primary is-magnetic"><?= $t['nav_cta'] ?></a>
            <button class="nav-toggle" id="navToggle" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>

<div class="nav-mobile " id="navMobile" role="navigation" aria-label="<?= $lang === 'sr' ? 'Mobilna navigacija' : 'Mobile navigation' ?>" aria-hidden="true">
    <a href="#services"><?= $t['nav_services'] ?></a>
    <a href="#about"><?= $t['nav_about'] ?></a>
    <a href="#process"><?= $t['nav_process'] ?></a>
    <a href="#faq"><?= $t['nav_faq'] ?></a>
    <a href="#references"><?= $t['nav_references'] ?></a>
    <a href="#contact"><?= $t['nav_contact'] ?></a>
</div>

<main id="main">

<!-- HERO -->
<header class="hero" id="home">
    <div class="hero-glow" id="heroGlow" aria-hidden="true"></div>
    <div class="container position-relative">
        <div class="hero-tag">
            <span class="dot"></span>
            <span class="line"></span>
            <?= $t['hero_badge'] ?>
        </div>

        <h1 class="hero-title">
            <?= $t['hero_title_1'] ?>
            <em><?= $t['hero_title_2'] ?></em>
        </h1>

        <p class="hero-lead"><?= $t['hero_subtitle'] ?></p>

        <div class="hero-actions">
            <a href="#contact" class="btn btn--primary is-magnetic">
                <?= $t['hero_cta_primary'] ?>
                <?= vug_icon('arrow-right') ?>
            </a>
            <a href="#services" class="btn btn--link">
                <?= $t['hero_cta_secondary'] ?>
                <?= vug_icon('arrow-right') ?>
            </a>
        </div>

        <div class="hero-meta">
            <div class="hero-meta-item">
                <div class="num"><span class="counter" data-target="54" data-suffix="+">0</span></div>
                <div class="label"><?= $t['hero_stat_1_label'] ?></div>
            </div>
            <div class="hero-meta-item">
                <div class="num"><span class="counter" data-target="11" data-suffix="+">0</span></div>
                <div class="label"><?= $t['hero_stat_2_label'] ?></div>
            </div>
            <div class="hero-meta-item">
                <div class="num"><?= $t['hero_stat_3_num'] ?></div>
                <div class="label"><?= $t['hero_stat_3_label'] ?></div>
            </div>
        </div>
    </div>

    <div class="scroll-cue" aria-hidden="true">
        <span><?= $lang === 'sr' ? 'Skroluj' : 'Scroll' ?></span>
        <span class="stick"></span>
    </div>
</header>

<!-- 01 SERVICES -->
<section class="section section--cream" id="services" aria-labelledby="services-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>01</strong><span class="line"></span><span><?= $t['services_eyebrow'] ?></span></div>
            <h2 class="s-title" id="services-title"><?= $t['services_title'] ?> <em>—</em></h2>
            <p class="s-lead"><?= $t['services_subtitle'] ?></p>
        </div>

        <div class="svc-grid stagger">
            <?php
            $services = [
                ['icon' => 'bi-code-slash', 'title' => $t['service_1_title'], 'desc' => $t['service_1_desc'], 'tags' => [$t['service_1_tag_1'], $t['service_1_tag_2'], $t['service_1_tag_3'], $t['service_1_tag_4']]],
                ['icon' => 'bi-phone',      'title' => $t['service_3_title'], 'desc' => $t['service_3_desc'], 'tags' => [$t['service_3_tag_1'], $t['service_3_tag_2'], $t['service_3_tag_3']]],
                ['icon' => 'bi-palette2',   'title' => $t['service_4_title'], 'desc' => $t['service_4_desc'], 'tags' => [$t['service_4_tag_1'], $t['service_4_tag_2'], $t['service_4_tag_3']]],
                ['icon' => 'bi-instagram',  'title' => $t['service_5_title'], 'desc' => $t['service_5_desc'], 'tags' => [$t['service_5_tag_1'], $t['service_5_tag_2'], $t['service_5_tag_3']]],
                ['icon' => 'bi-graph-up',   'title' => $t['service_6_title'], 'desc' => $t['service_6_desc'], 'tags' => [$t['service_6_tag_1'], $t['service_6_tag_2'], $t['service_6_tag_3']]],
            ];
            foreach ($services as $i => $s):
                $n = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
            ?>
            <a href="#contact" class="svc js-svc">
                <div class="svc-head">
                    <span class="svc-num">/ <?= $n ?></span>
                    <span class="svc-icon"><?= vug_icon($s['icon']) ?></span>
                </div>
                <h3 class="svc-title"><?= $s['title'] ?></h3>
                <p class="svc-desc"><?= $s['desc'] ?></p>
                <div class="svc-tags">
                    <?php foreach ($s['tags'] as $tag): ?>
                        <span class="svc-tag"><?= $tag ?></span>
                    <?php endforeach; ?>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 02 ABOUT -->
<section class="section" id="about" aria-labelledby="about-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>02</strong><span class="line"></span><span><?= $t['about_eyebrow'] ?></span></div>
            <h2 class="s-title" id="about-title"><?= $t['about_title'] ?></h2>
        </div>

        <div class="about-grid">
            <div class="reveal">
                <p class="about-quote"><em>"<?= $t['about_p1'] ?>"</em></p>
                <p class="about-quote" style="font-size: clamp(17px, 1.6vw, 21px); color: var(--txt-soft); font-weight: 400;">
                    <?= $t['about_p2'] ?>
                </p>
                <p class="about-quote" style="font-size: clamp(17px, 1.6vw, 21px); color: var(--txt-soft); font-weight: 400;">
                    <?= $t['about_p3'] ?>
                </p>
                <p class="about-quote" style="font-size: clamp(17px, 1.6vw, 21px); color: var(--txt-soft); font-weight: 400;">
                    <?= $t['about_p4'] ?>
                </p>
                <div class="about-attr">VUG Agency</div>
            </div>

            <div class="about-features stagger">
                <div class="feat">
                    <div class="feat-num">/ 01</div>
                    <h3 class="feat-title"><?= $t['about_feature_1_title'] ?></h3>
                    <p class="feat-desc"><?= $t['about_feature_1_desc'] ?></p>
                </div>
                <div class="feat">
                    <div class="feat-num">/ 02</div>
                    <h3 class="feat-title"><?= $t['about_feature_2_title'] ?></h3>
                    <p class="feat-desc"><?= $t['about_feature_2_desc'] ?></p>
                </div>
                <div class="feat">
                    <div class="feat-num">/ 03</div>
                    <h3 class="feat-title"><?= $t['about_feature_3_title'] ?></h3>
                    <p class="feat-desc"><?= $t['about_feature_3_desc'] ?></p>
                </div>
                <div class="feat">
                    <div class="feat-num">/ 04</div>
                    <h3 class="feat-title"><?= $t['about_feature_4_title'] ?></h3>
                    <p class="feat-desc"><?= $t['about_feature_4_desc'] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 03 PROCESS -->
<section class="section section--light" id="process" aria-labelledby="process-title">
    <div class="container">
        <div class="s-head s-head--center reveal">
            <div class="s-index" style="justify-content: center;"><strong>03</strong><span class="line"></span><span><?= $t['process_eyebrow'] ?></span></div>
            <h2 class="s-title" id="process-title" style="margin-left: auto; margin-right: auto;"><?= $t['process_title'] ?></h2>
            <p class="s-lead"><?= $t['process_subtitle'] ?></p>
        </div>

        <div class="process-list stagger">
            <?php
            $steps = [
                [$t['process_1_title'], $t['process_1_desc']],
                [$t['process_2_title'], $t['process_2_desc']],
                [$t['process_3_title'], $t['process_3_desc']],
                [$t['process_4_title'], $t['process_4_desc']],
            ];
            foreach ($steps as $i => $st):
                $n = str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT);
            ?>
            <div class="step">
                <div class="step-dot"><?= $n ?></div>
                <h3 class="step-title"><?= $st[0] ?></h3>
                <p class="step-desc"><?= $st[1] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- × CTA — Sledeci korak -->
<section class="cta-pro" id="cta" aria-labelledby="cta-title">
    <div class="cta-pro-mesh" aria-hidden="true"></div>
    <div class="container">
        <div class="cta-pro-card reveal">
            <span class="cta-pro-eyebrow">
                <span class="bullet">×</span>
                <?= $t['cta_eyebrow'] ?>
            </span>
            <h2 class="cta-pro-title" id="cta-title">
                <?= $lang === 'sr' ? 'Dobra ideja zaslužuje' : 'A great idea deserves' ?>
                <em><?= $lang === 'sr' ? 'pravu realizaciju' : 'real execution' ?></em>
            </h2>
            <p class="cta-pro-lead"><?= $t['cta_subtitle'] ?></p>

            <ul class="cta-pro-perks">
                <li><?= vug_icon('check2-circle') ?> <?= $lang === 'sr' ? 'Besplatna konsultacija' : 'Free consultation' ?></li>
                <li><?= vug_icon('check2-circle') ?> <?= $lang === 'sr' ? 'Ponuda u roku od 48h' : 'Quote within 48h' ?></li>
                <li><?= vug_icon('check2-circle') ?> <?= $lang === 'sr' ? 'Bez obaveza' : 'No strings attached' ?></li>
            </ul>

            <div class="cta-pro-actions">
                <a href="#contact" class="btn btn--primary cta-pro-main">
                    <?= $t['cta_primary'] ?>
                    <?= vug_icon('arrow-up-right') ?>
                </a>
                <a href="tel:<?= $phone_clean ?>" class="btn btn--ghost">
                    <?= vug_icon('telephone-fill') ?>
                    <?= $t['contact_info_phone'] ?>
                </a>
            </div>

            <div class="cta-pro-meta">
                <span class="pulse"></span>
                <?= $lang === 'sr' ? 'Odgovaramo u roku od nekoliko minuta.' : 'We reply within a few minutes.' ?>
            </div>
        </div>
    </div>
</section>

<!-- 04 TESTIMONIALS -->
<section class="section section--cream" id="testimonials" aria-labelledby="testimonials-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>04</strong><span class="line"></span><span><?= $t['testimonials_eyebrow'] ?></span></div>
            <h2 class="s-title" id="testimonials-title"><?= $t['testimonials_title'] ?></h2>
            <p class="s-lead"><?= $t['testimonials_subtitle'] ?></p>
        </div>

        <div class="t-marquee reveal">
            <div class="t-marquee-track">
                <?php
                $testimonials = [
                    ['quote' => $t['testimonial_1_quote'], 'name' => $t['testimonial_1_name'], 'role' => $t['testimonial_1_role']],
                    ['quote' => $t['testimonial_2_quote'], 'name' => $t['testimonial_2_name'], 'role' => $t['testimonial_2_role']],
                    ['quote' => $t['testimonial_3_quote'], 'name' => $t['testimonial_3_name'], 'role' => $t['testimonial_3_role']],
                    ['quote' => $t['testimonial_7_quote'], 'name' => $t['testimonial_7_name'], 'role' => $t['testimonial_7_role']],
                    ['quote' => $t['testimonial_5_quote'], 'name' => $t['testimonial_5_name'], 'role' => $t['testimonial_5_role']],
                    ['quote' => $t['testimonial_6_quote'], 'name' => $t['testimonial_6_name'], 'role' => $t['testimonial_6_role']],
                    ['quote' => $t['testimonial_4_quote'], 'name' => $t['testimonial_4_name'], 'role' => $t['testimonial_4_role']],
                    ['quote' => $t['testimonial_8_quote'], 'name' => $t['testimonial_8_name'], 'role' => $t['testimonial_8_role']],
                ];
                // Render twice za seamless loop
                for ($pass = 0; $pass < 2; $pass++):
                    foreach ($testimonials as $tst):
                        $initials = '';
                        foreach (explode(' ', $tst['name']) as $w) { $initials .= mb_substr($w, 0, 1); }
                        $initials = mb_strtoupper(mb_substr($initials, 0, 2));
                ?>
                <article class="t-card" <?= $pass === 1 ? 'aria-hidden="true"' : '' ?>>
                    <div class="t-mark">"</div>
                    <p class="t-quote"><?= $tst['quote'] ?></p>
                    <div class="t-stars" aria-label="5/5">
                        <?= vug_icon('star-fill') ?><?= vug_icon('star-fill') ?><?= vug_icon('star-fill') ?><?= vug_icon('star-fill') ?><?= vug_icon('star-fill') ?>
                    </div>
                    <div class="t-author">
                        <div class="t-avatar"><?= $initials ?></div>
                        <div>
                            <div class="t-author-name"><?= $tst['name'] ?></div>
                            <div class="t-author-role"><?= $tst['role'] ?></div>
                        </div>
                    </div>
                </article>
                <?php endforeach; endfor; ?>
            </div>
        </div>
    </div>
</section>

<!-- 06 FAQ — card grid -->
<section class="section section--light" id="faq" aria-labelledby="faq-title">
    <div class="container">
        <div class="s-head s-head--center reveal">
            <div class="s-index" style="justify-content: center;"><strong>05</strong><span class="line"></span><span><?= $t['faq_eyebrow'] ?></span></div>
            <h2 class="s-title" id="faq-title" style="margin-left:auto; margin-right:auto;"><?= $t['faq_title'] ?></h2>
            <p class="s-lead" style="margin-left:auto; margin-right:auto;"><?= $t['faq_subtitle'] ?></p>
        </div>

        <div class="faq-cards stagger">
            <?php
            $faqs = [
                ['icon' => 'bi-briefcase',    'q' => $t['faq_1_q'],  'a' => $t['faq_1_a']],
                ['icon' => 'bi-cash-coin',    'q' => $t['faq_2_q'],  'a' => $t['faq_2_a']],
                ['icon' => 'bi-clock',        'q' => $t['faq_3_q'],  'a' => $t['faq_3_a']],
                ['icon' => 'bi-arrow-repeat', 'q' => $t['faq_4_q'],  'a' => $t['faq_4_a']],
                ['icon' => 'bi-tools',        'q' => $t['faq_5_q'],  'a' => $t['faq_5_a']],
                ['icon' => 'bi-chat-dots',    'q' => $t['faq_6_q'],  'a' => $t['faq_6_a']],
                ['icon' => 'bi-diagram-3',    'q' => $t['faq_7_q'],  'a' => $t['faq_7_a']],
                ['icon' => 'bi-graph-up',     'q' => $t['faq_8_q'],  'a' => $t['faq_8_a']],
                ['icon' => 'bi-chat-left-text','q' => $t['faq_9_q'], 'a' => $t['faq_9_a']],
                ['icon' => 'bi-geo-alt',      'q' => $t['faq_10_q'], 'a' => $t['faq_10_a']],
            ];
            foreach ($faqs as $idx => $f):
                $n = str_pad((string)($idx + 1), 2, '0', STR_PAD_LEFT);
            ?>
            <details class="faq-card"<?= $idx === 0 ? ' open' : '' ?>>
                <summary class="faq-card-summary">
                    <div class="faq-card-head">
                        <span class="faq-card-num"><?= $n ?></span>
                        <span class="faq-card-ic"><?= vug_icon($f['icon']) ?></span>
                    </div>
                    <h3 class="faq-card-q"><?= $f['q'] ?></h3>
                    <span class="faq-card-toggle" aria-hidden="true"></span>
                </summary>
                <div class="faq-card-a"><?= $f['a'] ?></div>
            </details>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php /*
==========================================================================
TODO (kredibilitet) — PRIPREMLJENA STRUKTURA, NE PRIKAZUJE SE U PRODUKCIJI.
Odkomentarisati i popuniti ISKLJUČIVO stvarnim, proverljivim podacima.
Ne izmišljati procente, prihode, broj korisnika ni rezultate.

CASE STUDY (npr. Padel Pančevo — rezervacioni sistem, već pomenut u testimonijalima):
<section class="section" id="case-study" aria-labelledby="cs-title">
  <div class="container">
    <div class="s-head reveal">
      <div class="s-index"><strong>—</strong><span class="line"></span><span>Case study</span></div>
      <h2 class="s-title" id="cs-title">[Naziv projekta / klijent]</h2>
    </div>
    <div class="reveal">
      <h3>Problem</h3><p>[početni problem klijenta]</p>
      <h3>Cilj</h3><p>[cilj projekta]</p>
      <h3>Usluga i realizacija</h3><p>[šta je VUG uradio i kako]</p>
      <h3>Isporučena rešenja</h3><p>[funkcionalnosti]</p>
      <h3>Rezultat</h3><p>[SAMO ako je potvrđen u postojećem sadržaju]</p>
      <a class="btn btn--primary" href="#contact">Pokrenite sličan projekat</a>
    </div>
  </div>
</section>

TEAM ("Ko stoji iza VUG-a") — samo ako postoje stvarni podaci (ime, uloga, foto):
<section class="section" id="team" aria-labelledby="team-title">
  <div class="container">
    <div class="s-head reveal"><h2 class="s-title" id="team-title">Ko stoji iza VUG-a</h2></div>
    <div class="stagger">
      <div class="feat"><h3 class="feat-title">[Ime i prezime]</h3><p class="feat-desc">[uloga]</p></div>
    </div>
  </div>
</section>
==========================================================================
*/ ?>
<!-- 06 REFERENCES -->
<section class="section" id="references" aria-labelledby="references-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>06</strong><span class="line"></span><span><?= $t['references_eyebrow'] ?></span></div>
            <h2 class="s-title" id="references-title"><?= $t['references_title'] ?></h2>
            <p class="s-lead"><?= $t['references_subtitle'] ?></p>
        </div>

        <div class="refs reveal">
            <?php
            // w/h = originalne dimenzije (za aspect-ratio hint); WebP verzija se servira preko <picture>.
            $partners = [
                ['file' => 'janko.PNG',        'name' => 'Janko Maksimović', 'href' => 'https://jankomaksimovic.rs/', 'w' => 360, 'h' => 200],
                ['file' => 'stetext.png',      'name' => 'Stetext' , 'href' => 'https://stetex.rs/', 'w' => 200, 'h' => 83],
                ['file' => 'qelectronics.png', 'name' => 'Q Electronics' , 'href' => 'https://qelectronics.rs/', 'w' => 600, 'h' => 100],
                ['file' => 'gotovac.png',      'name' => 'Gotovac' , 'href' => 'https://advokatigotovac.com/', 'w' => 640, 'h' => 144],
                ['file' => 'padel.PNG',        'name' => 'Padel Pančevo' , 'href' => 'https://padelpancevo.com/', 'w' => 500, 'h' => 500],
                ['file' => 'tara.png',         'name' => 'Tara' , 'href' => 'https://taraorg.com/', 'w' => 550, 'h' => 416],
                ['file' => 'vastrener.webp',   'name' => 'Vaš Trener' , 'href' => 'http://vastrener.com/', 'w' => 350, 'h' => 309],
                ['file' => 'rakija.png',       'name' => 'Rakia Connect' , 'href' => 'https://rakia-connect.com/', 'w' => 600, 'h' => 326],
                ['file' => 'kalupizza.PNG',    'name' => 'Kalu Pizza' , 'href' => 'https://kalupizza.rs/', 'w' => 500, 'h' => 374],
                ['file' => 'moravka.png',      'name' => 'Pro-Moravka' , 'href' => 'https://promoravka.rs/', 'w' => 500, 'h' => 500],
                ['file' => 'kosta.png',        'name' => 'Kosta' , 'href' => 'https://advokati-rs.com/beograd/yuristy/kosta-panovski/', 'w' => 428, 'h' => 573],
                ['file' => 'pro-tim.png',      'name' => 'PRO-TIM Auto Plac' , 'href' => 'https://www.polovniautomobili.com/pro-tim-auto-plac-kragujevac', 'w' => 640, 'h' => 640],
            ];
            foreach ($partners as $p):
                $webp = pathinfo($p['file'], PATHINFO_FILENAME) . '.webp';
            ?>
            <a class="ref" href="<?= htmlspecialchars($p['href']) ?>" target="_blank" rel="noopener noreferrer"
               aria-label="<?= htmlspecialchars($p['name']) ?>">
                <picture>
                    <source type="image/webp" srcset="img/partners/<?= rawurlencode($webp) ?>">
                    <img src="img/partners/<?= rawurlencode($p['file']) ?>"
                         alt="<?= htmlspecialchars($p['name']) ?> — logo"
                         width="<?= $p['w'] ?>" height="<?= $p['h'] ?>"
                         loading="lazy" decoding="async">
                </picture>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 07 CONTACT — klasican stil sa info karticama -->
<section class="section section--light" id="contact" aria-labelledby="contact-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>07</strong><span class="line"></span><span><?= $t['contact_eyebrow'] ?></span></div>
            <h2 class="s-title" id="contact-title"><?= $t['contact_title'] ?></h2>
            <p class="s-lead"><?= $t['contact_subtitle'] ?></p>
        </div>

        <div class="contact-classic">
            <div class="contact-info-block reveal">
                <ul class="info-cards">
                    <li>
                        <div class="info-ic"><?= vug_icon('envelope-fill') ?></div>
                        <div>
                            <span class="info-label">Email</span>
                            <a href="mailto:<?= $t['contact_info_email'] ?>"><?= $t['contact_info_email'] ?></a>
                        </div>
                    </li>
                    <li>
                        <div class="info-ic"><?= vug_icon('telephone-fill') ?></div>
                        <div>
                            <span class="info-label"><?= $lang === 'sr' ? 'Telefon' : 'Phone' ?></span>
                            <a href="tel:<?= $phone_intl ?>"><?= $t['contact_info_phone'] ?></a>
                        </div>
                    </li>
                    <li>
                        <div class="info-ic"><?= vug_icon('geo-alt-fill') ?></div>
                        <div>
                            <span class="info-label"><?= $lang === 'sr' ? 'Sedište' : 'HQ' ?></span>
                            <span><?= $t['contact_info_location'] ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="info-ic"><?= vug_icon('clock-fill') ?></div>
                        <div>
                            <span class="info-label"><?= $lang === 'sr' ? 'Radno vreme' : 'Hours' ?></span>
                            <span><?= $t['contact_info_hours'] ?></span>
                        </div>
                    </li>
                </ul>

                <div class="socials">
                    <a href="https://www.instagram.com/vugagency" target="_blank" rel="noopener" aria-label="Instagram"><?= vug_icon('instagram') ?></a>
                    <a href="https://www.facebook.com/profile.php?id=61592111037904" target="_blank" rel="noopener" aria-label="Facebook"><?= vug_icon('facebook') ?></a>
                    <a href="https://www.linkedin.com/company/vug-digital-agency/" target="_blank" rel="noopener" aria-label="LinkedIn"><?= vug_icon('linkedin') ?></a>
                </div>
            </div>

            <form class="contact-form-classic reveal" id="contactForm" action="php/contact.php" method="POST" novalidate data-recaptcha-key="<?= htmlspecialchars($RECAPTCHA_SITE_KEY, ENT_QUOTES, 'UTF-8') ?>" data-recaptcha-action="contact">
                <input type="hidden" name="lang" value="<?= $lang ?>">
                <input type="text" name="website" class="honeypot" tabindex="-1" autocomplete="off" aria-hidden="true">

                <div class="form-row">
                    <label for="name"><?= vug_icon('person') ?> <?= $t['form_name'] ?></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="<?= $t['form_name_ph'] ?>" required minlength="2" maxlength="80">
                    <span class="form-error" data-for="name"></span>
                </div>
                <div class="form-row">
                    <label for="email"><?= vug_icon('envelope') ?> <?= $t['form_email'] ?></label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="<?= $t['form_email_ph'] ?>" required maxlength="120">
                    <span class="form-error" data-for="email"></span>
                </div>
                <div class="form-row">
                    <label for="subject"><?= vug_icon('tag') ?> <?= $t['form_subject'] ?></label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="<?= $t['form_subject_ph'] ?>" required minlength="3" maxlength="120">
                    <span class="form-error" data-for="subject"></span>
                </div>
                <div class="form-row">
                    <label for="message"><?= vug_icon('chat-left-text') ?> <?= $t['form_message'] ?></label>
                    <textarea id="message" name="message" rows="5" class="form-control" placeholder="<?= $t['form_message_ph'] ?>" required minlength="3"></textarea>
                    <div class="form-row-foot">
                        <span class="form-error" data-for="message"></span>
                        <span class="form-counter" data-for="message" aria-live="polite">0 / 3000</span>
                    </div>
                </div>

                <button type="submit" class="btn btn--primary submit-btn" id="submitBtn">
                    <span class="btn-label"><?= vug_icon('send-fill') ?> <?= $t['form_submit'] ?></span>
                </button>

                <div class="form-feedback" id="formFeedback" role="status" aria-live="polite"></div>

                <script type="application/json" id="formMessages">
                {
                    "success": <?= json_encode($t['form_success'], JSON_UNESCAPED_UNICODE) ?>,
                    "error": <?= json_encode($t['form_error'], JSON_UNESCAPED_UNICODE) ?>,
                    "sending": <?= json_encode($t['form_sending'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_name": <?= json_encode($t['form_err_name'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_email": <?= json_encode($t['form_err_email'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_subject": <?= json_encode($t['form_err_subject'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_message": <?= json_encode($t['form_err_message'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_message_max": <?= json_encode($t['form_err_message_max'], JSON_UNESCAPED_UNICODE) ?>
                }
                </script>
            </form>
        </div>
    </div>
</section>

</main>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div>
                <a href="<?= $href_home ?>" class="brand brand--footer">
                    <img src="img/logoes/logo-blue-white-c.png" alt="VUG Digital Agency" class="brand-logo" width="572" height="120" loading="lazy">
                </a>
                <p class="footer-tagline"><?= $t['footer_tagline'] ?></p>
                <div class="socials footer-socials">
                    <a href="https://www.instagram.com/vugagency" target="_blank" rel="noopener" aria-label="Instagram"><?= vug_icon('instagram') ?></a>
                    <a href="https://www.facebook.com/profile.php?id=61592111037904" target="_blank" rel="noopener" aria-label="Facebook"><?= vug_icon('facebook') ?></a>
                    <a href="https://www.linkedin.com/company/vug-digital-agency/" target="_blank" rel="noopener" aria-label="LinkedIn"><?= vug_icon('linkedin') ?></a>
                </div>
            </div>
            <div>
                <div class="footer-h"><?= $t['footer_services'] ?></div>
                <ul class="footer-list">
                    <li><a href="#services"><?= $t['service_1_title'] ?></a></li>
                    <li><a href="#services"><?= $t['service_3_title'] ?></a></li>
                    <li><a href="#services"><?= $t['service_4_title'] ?></a></li>
                    <li><a href="#services"><?= $t['service_5_title'] ?></a></li>
                    <li><a href="#services"><?= $t['service_6_title'] ?></a></li>
                </ul>
            </div>
            <div>
                <div class="footer-h"><?= $t['footer_company'] ?></div>
                <ul class="footer-list">
                    <li><a href="#about"><?= $t['nav_about'] ?></a></li>
                    <li><a href="#process"><?= $t['nav_process'] ?></a></li>
                    <li><a href="#faq"><?= $t['nav_faq'] ?></a></li>
                    <li><a href="#contact"><?= $t['nav_contact'] ?></a></li>
                </ul>
            </div>
            <div>
                <div class="footer-h"><?= $t['footer_contact'] ?></div>
                <ul class="footer-list">
                    <li><?= vug_icon('envelope') ?><a href="mailto:<?= $t['contact_info_email'] ?>"><?= $t['contact_info_email'] ?></a></li>
                    <li><?= vug_icon('telephone') ?><a href="tel:<?= $phone_clean ?>"><?= $t['contact_info_phone'] ?></a></li>
                    <li><?= vug_icon('geo-alt') ?><?= $t['contact_info_location'] ?></li>
                </ul>
            </div>
        </div>
        <?php
        // Pravne stranice — cisti URL-ovi (base-path aware); EN dobija ?lang=en.
        $legal_q = $lang === 'en' ? '?lang=en' : '';
        $legal_privacy = $base_path . '/politika-privatnosti' . $legal_q;
        $legal_terms   = $base_path . '/uslovi-koriscenja' . $legal_q;
        $legal_cookies = $base_path . '/politika-kolacica' . $legal_q;
        ?>
        <div class="footer-bottom">
            <span>&copy; <?= date('Y') ?> VUG. <?= $t['footer_rights'] ?></span>
            <nav class="footer-legal" aria-label="<?= $t['footer_legal'] ?>">
                <a href="<?= $legal_privacy ?>"><?= $t['footer_privacy'] ?></a>
                <a href="<?= $legal_terms ?>"><?= $t['footer_terms'] ?></a>
                <a href="<?= $legal_cookies ?>"><?= $t['footer_cookies'] ?></a>
            </nav>
            <span><?= $t['footer_made'] ?></span>
        </div>
    </div>
</footer>

<a href="#home" class="to-top" aria-label="Top"><?= vug_icon('arrow-up') ?></a>

<!-- reCAPTCHA se učitava LENJO (na prvu interakciju sa formom) preko js/main.js,
     da ne bi blokirala inicijalni render niti trošila ~250KB na svakom učitavanju. -->
<script src="js/main.js?v=<?= @filemtime(__DIR__ . '/js/main.js') ?>" defer></script>
</body>
</html>