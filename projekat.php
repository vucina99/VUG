<?php
/**
 * VUG — stranica pojedinačnog projekta (case study).
 *
 * Rute (root .htaccess):
 *   /projekti/<slug>          -> projekat.php?slug=<slug>
 *   /en/projects/<slug>       -> projekat.php?slug=<slug>&lang=en
 *
 * Nepoznat slug -> prava 404 stranica (404.php je samostalna, sama postavlja
 * status i sve svoje varijable).
 *
 * Ovaj fajl je KONTROLER: rutiranje, podaci, SEO/JSON-LD i lightbox.
 * Sam prikaz ide kroz jedan od DVA ŠABLONA, jer
 * sajt i vođenje društvenih mreža nisu isti slučaj:
 *
 *   partials/project-web.php     — cat 'web' | 'web-app'  (ekran u browser ramu,
 *                                  tok rada, funkcionalnosti, tehnologije)
 *   partials/project-social.php  — cat 'social'           (profil i mreža objava,
 *                                  rubrike 9:16, kalendar objavljivanja, kanali)
 *
 * Oba šablona dele zatvaranje stranice (partials/project-close.php) i drže isti
 * ritam sekcija kao početna (tamno -> svetlo -> tamno), sa SVETLOM poslednjom
 * sekcijom, jer je futer već taman.
 *
 * Akcentne boje projekta ulaze kroz --pa1/--pa2 u $extra_head, pa cela stranica
 * (glow, badge, metrike, ikonice) prati boju tog projekta. Sve .pd-/.pdw-/.pds-
 * klase su u css/style.css.
 */

$slug = strtolower((string) ($_GET['slug'] ?? ''));
$slug = preg_replace('/[^a-z0-9-]/', '', $slug);

$lang = (($_GET['lang'] ?? '') === 'en' || preg_match('#/en/#', $_SERVER['REQUEST_URI'] ?? '')) ? 'en' : 'sr';
$t = require __DIR__ . '/lang/' . $lang . '.php';
require __DIR__ . '/php/icons.php';
require __DIR__ . '/php/projects.php';

$p = vug_project($slug, $lang);
if ($p === null) {
    require __DIR__ . '/404.php';
    exit;
}

$SITE_URL = 'https://vugagency.com';
$base     = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
$home     = $lang === 'en' ? $base . '/en' : ($base === '' ? '/' : $base . '/');
$pf_url   = vug_projects_url($base, $lang);

$abs_sr    = $SITE_URL . '/projekti/' . $slug;
$abs_en    = $SITE_URL . '/en/projects/' . $slug;
$canonical = $lang === 'en' ? $abs_en : $abs_sr;

$sib         = vug_project_siblings($slug, $lang);
$phone_clean = preg_replace('/\s+/', '', $t['contact_info_phone']);
$template    = vug_project_template($p);

/* ── SEO ── */
$meta_title       = $p['title'] . ' — ' . $p['cat_label'] . ' | VUG';
$meta_description = mb_substr($p['tagline'], 0, 158);
$meta_keywords    = implode(', ', array_merge([$p['title'], $p['cat_label']], array_slice($p['services'], 0, 4)));
$og_image         = $SITE_URL . '/img/og-image.png'; // OG mora da bude raster (SVG ne prolazi na mrežama)
$og_type          = 'article';
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
            '@type' => 'CreativeWork',
            '@id' => $canonical . '#project',
            'name' => $p['title'],
            'headline' => $p['tagline'],
            'description' => $p['summary'],
            'url' => $canonical,
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
            'dateCreated' => $p['year'],
            'genre' => $p['cat_label'],
            'keywords' => implode(', ', $p['stack']),
            'creator' => ['@id' => $SITE_URL . '/#organization'],
            'image' => $SITE_URL . '/' . $p['cover'],
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => $t['nav_home'],     'item' => $SITE_URL . ($lang === 'en' ? '/en' : '/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $t['nav_projects'], 'item' => $SITE_URL . vug_projects_url('', $lang)],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $p['title'],        'item' => $canonical],
            ],
        ],
    ],
];

/* ── Konfiguracija deljenih partiala ── */
$nav_prefix       = $home;
$contact_href     = $home . '#contact';
$cta_href         = $home . '#contact';
$show_lang_toggle = true;
$href_other       = $lang === 'en'
    ? (($base === '' ? '' : $base) . '/projekti/' . $slug)
    : $base . '/en/projects/' . $slug;
$nav_active       = 'projects';

/* ── Above-the-fold: hero podstranice + akcentne boje ovog projekta ── */
$pa1 = htmlspecialchars($p['a1'], ENT_QUOTES);
$pa2 = htmlspecialchars($p['a2'], ENT_QUOTES);
$extra_head = <<<HTML
    <style>
        :root{--pa1:{$pa1};--pa2:{$pa2};}
        .hero--sub{min-height:auto;padding:calc(var(--nav-h) + 70px) 0 clamp(40px,5vw,64px);}
        .hero--sub .hero-title{font-size:clamp(34px,5.6vw,68px);max-width:22ch;}
        .hero--sub .hero-title em{display:inline;background:none;-webkit-text-fill-color:{$pa2};color:{$pa2};}
        .hero--sub .hero-glow{background:radial-gradient(circle,{$pa1}2e 0%,transparent 65%);}
        @media (max-width:991.98px){.hero--sub{padding:calc(var(--nav-h) + 40px) 0 40px;}}
    </style>
HTML;

require __DIR__ . '/partials/head.php';
// Traka napretka skrolovanja dolazi iz partials/header.php (na svim stranicama),
// samo je ovde obojena akcentom projekta preko --pa1/--pa2.
require __DIR__ . '/partials/header.php';
?>

<?php require __DIR__ . '/partials/project-' . $template . '.php'; ?>

<!-- LIGHTBOX (galerija) -->
<div class="lb" id="lightbox" role="dialog" aria-modal="true" aria-label="<?= htmlspecialchars($t['pd_gallery_title']) ?>" hidden>
    <button type="button" class="lb-close" id="lbClose" aria-label="<?= htmlspecialchars($t['pd_lb_close']) ?>"><?= vug_icon('x-lg') ?></button>
    <button type="button" class="lb-prev" id="lbPrev" aria-label="<?= htmlspecialchars($t['pd_lb_prev']) ?>"><?= vug_icon('chevron-left') ?></button>
    <img class="lb-img" id="lbImg" src="" alt="">
    <button type="button" class="lb-next" id="lbNext" aria-label="<?= htmlspecialchars($t['pd_lb_next']) ?>"><?= vug_icon('chevron-right') ?></button>
    <p class="lb-cap" id="lbCap"></p>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>
