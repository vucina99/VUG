<?php
/**
 * VUG — portfolio (lista svih projekata).
 *
 * Rute (root .htaccess):
 *   /projekti      -> projekti.php
 *   /en/projects   -> projekti.php?lang=en
 *
 * Sadržaj projekata dolazi iz php/projects.php. Dok je taj fajl u DEMO režimu
 * ($GLOBALS['VUG_PROJECTS_DEMO'] = true), stranica je noindex — da izmišljeni
 * projekti ne odu u pretragu.
 *
 * Hero koristi postojeće .hero* klase iz css/critical.css (inline, above-the-fold);
 * ovde je samo mali .hero--sub override. Mreža kartica je u css/style.css (.pf-*).
 */

// Sigurnosna mreža: ako na hostingu ostane uključen MultiViews, zahtev
// /projekti/<slug> stiže ovde kao PATH_INFO umesto da ga .htaccess prosledi
// projekat.php-u. U tom slučaju sami preuzimamo slug i renderujemo projekat.
$pi = trim((string) ($_SERVER['PATH_INFO'] ?? ''), '/');
if ($pi !== '') {
    $_GET['slug'] = $pi;
    require __DIR__ . '/projekat.php';
    exit;
}

$lang = (($_GET['lang'] ?? '') === 'en' || preg_match('#/en(/|$|\?)#', $_SERVER['REQUEST_URI'] ?? '')) ? 'en' : 'sr';
$t = require __DIR__ . '/lang/' . $lang . '.php';
require __DIR__ . '/php/icons.php';
require __DIR__ . '/php/projects.php';

$SITE_URL = 'https://vugagency.com';
$base     = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
$home     = $lang === 'en' ? $base . '/en' : ($base === '' ? '/' : $base . '/');

$abs_sr    = $SITE_URL . '/projekti';
$abs_en    = $SITE_URL . '/en/projects';
$canonical = $lang === 'en' ? $abs_en : $abs_sr;

$all       = vug_projects($lang);
$phone_clean = preg_replace('/\s+/', '', $t['contact_info_phone']); // koristi ga partials/footer.php

// Ukupan broj različitih tehnologija/alata kroz sve projekte (hero statistika)
$tools = [];
foreach ($all as $p) { foreach ($p['stack'] as $s) { $tools[$s] = true; } }

/* ── SEO ── */
$meta_title       = $t['pf_meta_title'];
$meta_description = $t['pf_meta_description'];
$meta_keywords    = $t['pf_meta_keywords'];
$og_image         = $SITE_URL . '/img/og-image.png';
$alt_links = [
    ['hreflang' => 'sr-RS',     'href' => $abs_sr],
    ['hreflang' => 'en',        'href' => $abs_en],
    ['hreflang' => 'x-default', 'href' => $abs_sr],
];
// DEMO sadržaj se ne indeksira (vidi php/projects.php).
$robots = !empty($GLOBALS['VUG_PROJECTS_DEMO'])
    ? 'noindex, nofollow'
    : 'index, follow, max-image-preview:large, max-snippet:-1';

$json_ld = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => $canonical . '#webpage',
            'url' => $canonical,
            'name' => $meta_title,
            'description' => $meta_description,
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
            'isPartOf' => ['@id' => $SITE_URL . '/#website'],
            'about' => ['@id' => $SITE_URL . '/#organization'],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => $t['nav_home'], 'item' => $SITE_URL . ($lang === 'en' ? '/en' : '/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $t['nav_projects'], 'item' => $canonical],
            ],
        ],
        [
            '@type' => 'ItemList',
            'name' => $t['nav_projects'],
            'numberOfItems' => count($all),
            'itemListElement' => array_values(array_map(static function ($p, $i) use ($SITE_URL, $lang) {
                return [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $p['title'],
                    'url' => $SITE_URL . vug_project_url('', $lang, $p['slug']),
                ];
            }, array_values($all), array_keys(array_values($all)))),
        ],
    ],
];

/* ── Konfiguracija deljenih partiala ── */
$nav_prefix       = $home;   // sidra vode na sekcije početne
$contact_href     = $home . '#contact';
$cta_href         = $home . '#contact';
$show_lang_toggle = true;
$href_other       = $lang === 'en' ? ($base === '' ? '/projekti' : $base . '/projekti') : $base . '/en/projects';
$nav_active       = 'projects';

/* ── Above-the-fold override: hero podstranice (ostalo je u css/style.css) ── */
$extra_head = <<<'HTML'
    <style>
        .hero--sub{min-height:auto;padding:calc(var(--nav-h) + 80px) 0 clamp(28px,4vw,52px);}
        .hero--sub .hero-title{max-width:26ch;}
        .hero--sub .hero-meta{margin-top:clamp(44px,5vw,72px);}
        .hero--sub .hero-lead{max-width:58ch;margin-bottom:40px;}
        @media (max-width:991.98px){.hero--sub{padding:calc(var(--nav-h) + 48px) 0 56px;}}
    </style>
HTML;

require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<!-- HERO -->
<header class="hero hero--sub" id="portfolio-top">
    <div class="hero-glow" id="heroGlow" aria-hidden="true"></div>
    <div class="container">
        <div class="hero-tag">
            <span class="dot"></span>
            <span class="line"></span>
            <?= htmlspecialchars($t['pf_badge']) ?>
        </div>

        <h1 class="hero-title">
            <?= htmlspecialchars($t['pf_title_1']) ?>
            <em><?= htmlspecialchars($t['pf_title_2']) ?></em>
        </h1>

        <p class="hero-lead"><?= htmlspecialchars($t['pf_lead']) ?></p>

        <div class="hero-actions">
            <a href="#work" class="btn btn--primary is-magnetic">
                <?= htmlspecialchars($t['pf_cta_scroll']) ?>
                <?= vug_icon('arrow-down') ?>
            </a>
            <a href="<?= $contact_href ?>" class="btn btn--link">
                <?= htmlspecialchars($t['cta_primary']) ?>
                <?= vug_icon('arrow-right') ?>
            </a>
        </div>

        <div class="hero-meta">
            <div class="hero-meta-item">
                <div class="num"><span class="counter" data-target="<?= count($all) ?>" data-suffix="">0</span></div>
                <div class="label"><?= htmlspecialchars($t['pf_stat_1_label']) ?></div>
            </div>
            <div class="hero-meta-item">
                <div class="num"><span class="counter" data-target="3" data-suffix="">0</span></div>
                <div class="label"><?= htmlspecialchars($t['pf_stat_2_label']) ?></div>
            </div>
            <div class="hero-meta-item">
                <div class="num"><span class="counter" data-target="<?= count($tools) ?>" data-suffix="+">0</span></div>
                <div class="label"><?= htmlspecialchars($t['pf_stat_3_label']) ?></div>
            </div>
        </div>
    </div>
</header>

<!-- Traka reči — prelaz od heroja ka mreži -->
<div class="pf-ticker" aria-hidden="true">
    <div class="pf-ticker-track">
        <?php // Gradijent ide po indeksu REČI (ne :nth-child), da oba prolaza
              // izgledaju identično i kad je broj reči neparan — inače se na
              // mestu gde se animacija vraća vidi skok u boji.
        for ($pass = 0; $pass < 2; $pass++):
            foreach ($t['pf_ticker'] as $wi => $w): ?>
                <span class="pf-ticker-item<?= $wi % 2 ? ' is-grad' : '' ?>"><?= htmlspecialchars($w) ?><span class="dot"></span></span>
        <?php endforeach; endfor; ?>
    </div>
</div>

<!-- 01 PROJEKTI: mreža (svetla sekcija, bele kartice).
     Filter po kategoriji i brojač „Prikazano X od Y" su uklonjeni
     (2026-08-05) — ne vraćati ih. -->
<section class="section section--cream" id="work" aria-labelledby="work-title">
    <div class="container">
        <div class="s-head reveal" style="margin-bottom: clamp(40px, 5vw, 64px);">
            <div class="s-index"><strong>01</strong><span class="line"></span><span><?= htmlspecialchars($t['projects_eyebrow']) ?></span></div>
            <h2 class="s-title" id="work-title"><?= htmlspecialchars($t['projects_title']) ?></h2>
            <p class="s-lead"><?= htmlspecialchars($t['projects_subtitle']) ?></p>
        </div>

        <div class="pf-grid stagger" id="pfGrid">
            <?php
            // Sve kartice su iste veličine — mreža je 2 kolone (vidi .pf-grid).
            foreach (array_values($all) as $i => $p):
                $lazy = $i > 1; // prvi red (2 kartice) je blizu prvog ekrana
                require __DIR__ . '/partials/project-card.php';
            endforeach;
            unset($lazy, $p);
            ?>
        </div>
    </div>
</section>

<!-- 02 OBLASTI RADA — pun spisak disciplina, bez izdvajanja.
     BELA sekcija: iznad tamnog futera NE sme da stoji tamna ljubičasta sekcija
     (isti raspored kao na početnoj, gde je poslednja sekcija #contact --light).
     Raspored: naslov levo + tekst desno, pa kompaktna mreža pločica (2 reda
     po 5 na širokom ekranu) — spisak jedan pod drugim je bio previsok. -->
<section class="section section--light" id="scope" aria-labelledby="scope-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>02</strong><span class="line"></span><span><?= htmlspecialchars($t['pf_scope_eyebrow']) ?></span></div>
            <h2 class="s-title" id="scope-title">
                <?= htmlspecialchars($t['pf_scope_title_1']) ?>
                <em><?= htmlspecialchars($t['pf_scope_title_2']) ?></em>
            </h2>
            <p class="s-lead"><?= htmlspecialchars($t['pf_scope_lead']) ?></p>
        </div>

        <!-- Mreža 2×2 BEZ kartica: polja su razdvojena samo tankim linijama u
             krst (border-top na svim, border-left na desnoj koloni). -->
        <div class="pf-areas stagger">
            <?php foreach ($t['pf_areas'] as $i => $a): ?>
            <article class="pf-area">
                <span class="pf-area-n"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="pf-area-title"><?= htmlspecialchars($a[0]) ?></h3>
                <p class="pf-area-desc"><?= htmlspecialchars($a[1]) ?></p>
                <ul class="pf-area-list">
                    <?php foreach ($a[2] as $item): ?>
                        <li><?= htmlspecialchars($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
            <?php endforeach; ?>
            <?php unset($a, $item); ?>
        </div>

        <!-- Poziv na kontakt — kompaktan red preko .pf-more (tekst + upit + telefon).
             NE vraćati veliki cta-pro blok, izričito uklonjen. -->
        <div class="pf-more reveal">
            <p class="pf-more-text"><?= $t['pf_contact_text'] ?></p>
            <div class="pf-more-actions">
                <a href="<?= $contact_href ?>" class="btn btn--primary is-magnetic">
                    <?= htmlspecialchars($t['cta_primary']) ?>
                    <?= vug_icon('arrow-up-right') ?>
                </a>
                <a href="tel:<?= $phone_clean ?>" class="btn btn--ghost">
                    <?= vug_icon('telephone-fill') ?>
                    <?= htmlspecialchars($t['contact_info_phone']) ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
