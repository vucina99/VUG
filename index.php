<?php
$lang = isset($_GET['lang']) && $_GET['lang'] === 'en' ? 'en' : 'sr';
$t = require __DIR__ . '/lang/' . $lang . '.php';
require __DIR__ . '/php/icons.php'; // inline SVG ikonice: vug_icon() + vug_icon_sprite()

// Produkcijski domen — koristi se za canonical, OG i JSON-LD.
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


// reCAPTCHA javni "site key" sada stoji u partials/contact.php (jedan izvor za
// sve stranice sa formom). Tajni "secret key" je i dalje u php/contact.php.
$other_lang  = $t['lang_other'];
$phone_clean = preg_replace('/\s+/', '', $t['contact_info_phone']);
// Telefon u međunarodnom formatu (E.164) za tel: i schema.org
$phone_intl  = '+381' . ltrim($phone_clean, '0');

// ── Konfiguracija za deljene partiale (partials/header.php + footer.php) ──
// Na početnoj su sidra ista stranica (bez prefiksa), CTA vodi na #contact,
// a prekidač jezika je uključen.
$base             = $base_path;
$home             = $href_home;
$nav_prefix       = '';
$contact_href     = '#contact';
$show_lang_toggle = true;

// Podaci o firmi za JSON-LD (naziv, adresa, geo, radno vreme, sameAs) - jedan
// izvor za početnu i landing stranice.
require __DIR__ . '/php/org.php';

// Structured data (schema.org @graph) — priprema se ispod i prosleđuje u partials/head.php.
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

// Interni linkovi u odgovorima FAQ-a (tokeni {lp_web_pancevo} / {lp_social_pancevo}
// u lang/*.php). U JSON-LD idu apsolutni URL-ovi, na stranici base-aware putanje
// (rade i u podfolderu na lokalu). EN vodi na /en/<slug> - EN posetilac ne sme
// da padne na srpsku stranicu.
$faq_lp = function ($prefix) use ($lang) {
    $p = $prefix . ($lang === 'sr' ? '' : '/en');
    return [
        '{lp_web_pancevo}'    => $p . '/izrada-web-sajta-pancevo',
        '{lp_social_pancevo}' => $p . '/vodjenje-drustvenih-mreza-pancevo',
    ];
};

$faq_entities = [];
for ($i = 1; $i <= 9; $i++) {
    $faq_entities[] = [
        '@type' => 'Question',
        'name' => $t["faq_{$i}_q"],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => strtr($t["faq_{$i}_a"], $faq_lp($SITE_URL))],
    ];
}

// Recenzije klijenata NAMERNO NISU u JSON-LD-u (uklonjeno 2026-10-06).
// Search Console je prijavio kritičnu grešku „više recenzija bez objekta za
// prosečnu ocenu“ (niz `review` bez `aggregateRating`). Rešenje NIJE dodavanje
// aggregateRating-a: Google ne prikazuje zvezdice za Organization/LocalBusiness
// kad firma sama objavljuje recenzije o sebi (self-serving reviews), pa markup
// ne bi doneo ništa osim rizika. Recenzije ostaju vidljive u sekciji #testimonials.

// Naziv brenda — JEDAN izvor za Organization i WebSite čvor (i na landing.php).
// Ciljamo brend pretrage „vug“, „vug agency“, „vug digital agency“, „vug pančevo“:
// pun naziv je `name`, kraći oblici su `alternateName`. Isti naziv stoji i u
// og:site_name, <title> i H1 početne - Google ih poredi kad bira naziv sajta.
// MORA da se poklapa sa nazivom u Google poslovnom profilu.
// Naziv i zajednički podaci su u php/org.php (VUG_BRAND_NAME / VUG_BRAND_ALT,
// vug_org_schema()); početna dodaje samo ono što je njeno: opis, kontakt i katalog usluga.
$brand_name = VUG_BRAND_NAME;
$brand_alt  = VUG_BRAND_ALT;

$org = vug_org_schema($SITE_URL, $lang, $phone_intl) + [
    'description' => $t['meta_description'],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'contactType' => $lang === 'sr' ? 'Prodaja i podrška' : 'Sales & support',
        'telephone' => $phone_intl,
        'availableLanguage' => ['Serbian', 'English'],
        'areaServed' => 'RS',
    ],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => $lang === 'sr' ? 'Digitalne usluge' : 'Digital services',
        'itemListElement' => $offers,
    ],
];

$schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        $org,
        [
            // Naziv sajta u Google rezultatima (site name) - mora biti na početnoj.
            '@type' => 'WebSite',
            '@id' => $site_id,
            'url' => $SITE_URL . '/',
            'name' => $brand_name,
            'alternateName' => $brand_alt,
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

/* ── SEO varijable za deljeni head (partials/head.php) ── */
$meta_title       = $t['meta_title'];
$meta_description = $t['meta_description'];
// Bez hreflang-a: indeksira se samo srpska verzija (pravilo je u partials/head.php).
$geo_region    = 'RS-14';
$geo_placename = 'Pančevo';
$json_ld       = $schema;

require __DIR__ . '/partials/head.php';
?>
<?php require __DIR__ . '/partials/header.php'; ?>

<!-- HERO -->
<header class="hero" id="home">
    <div class="hero-glow" id="heroGlow" aria-hidden="true"></div>
    <div class="container position-relative">
        <?php /* H1 = naziv brenda (hero_badge: „VUG Digitalna agencija“; „· Pančevo“ uklonjeno 2026-10-28) + slogan („Gradimo brendove koji se pamte“).
                 Brend MORA da bude u H1 početne - to je jedan od signala po kojima
                 Google bira naziv sajta i rangira brend pretrage („vug pančevo“).
                 Vizuelno se ništa ne menja: .hero-h1 je samo omotač, a delovi
                 zadržavaju postojeće klase .hero-tag / .hero-title. */ ?>
        <h1 class="hero-h1">
            <span class="hero-tag">
                <span class="dot"></span>
                <span class="line"></span>
                <?= $t['hero_badge'] ?>
            </span>
            <span class="hero-title">
                <?= $t['hero_title_1'] ?>
                <em><?= $t['hero_title_2'] ?></em>
            </span>
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
                <div class="num"><span class="counter" data-target="54" data-suffix="+">54+</span></div>
                <div class="label"><?= $t['hero_stat_1_label'] ?></div>
            </div>
            <div class="hero-meta-item">
                <div class="num"><span class="counter" data-target="11" data-suffix="+">11+</span></div>
                <div class="label"><?= $t['hero_stat_2_label'] ?></div>
            </div>
            <div class="hero-meta-item">
                <div class="num"><?= $t['hero_stat_3_num'] ?></div>
                <div class="label"><?= $t['hero_stat_3_label'] ?></div>
            </div>
        </div>
    </div>

    <div class="scroll-cue" aria-hidden="true">
        <span><?= $lang === 'sr' ? 'Skrolujte' : 'Scroll' ?></span>
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
                ['icon' => 'bi-instagram',  'title' => $t['service_5_title'], 'desc' => $t['service_5_desc'], 'tags' => [$t['service_5_tag_1'], $t['service_5_tag_2'], $t['service_5_tag_3']]],
                ['icon' => 'bi-palette2',   'title' => $t['service_4_title'], 'desc' => $t['service_4_desc'], 'tags' => [$t['service_4_tag_1'], $t['service_4_tag_2'], $t['service_4_tag_3']]],
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

        <?php // Linkovi ka lokalnim landing stranicama su u meniju (padajuća lista „Usluge“)
              // i u futeru - pasus „Poslujete u Beogradu ili Pančevu?“ je uklonjen 2026-10-19. ?>
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
                <div class="about-attr">VUG Digital Agency</div>
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
                <li><?= vug_icon('check2-circle') ?> <?= $lang === 'sr' ? 'Ponuda u roku od 24h' : 'Quote within 24h' ?></li>
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
<?php
// Sekcija je u partials/testimonials.php (isti markup koriste i landing stranice).
$tst_num   = '04';
$tst_class = 'section section--cream';
require __DIR__ . '/partials/testimonials.php';
?>

<!-- 05 FAQ — card grid -->
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
                ['icon' => 'bi-arrow-repeat', 'q' => $t['faq_3_q'],  'a' => $t['faq_3_a']],
                ['icon' => 'bi-tools',        'q' => $t['faq_4_q'],  'a' => $t['faq_4_a']],
                ['icon' => 'bi-chat-dots',    'q' => $t['faq_5_q'],  'a' => $t['faq_5_a']],
                ['icon' => 'bi-diagram-3',    'q' => $t['faq_6_q'],  'a' => $t['faq_6_a']],
                ['icon' => 'bi-graph-up',     'q' => $t['faq_7_q'],  'a' => $t['faq_7_a']],
                ['icon' => 'bi-chat-left-text','q' => $t['faq_8_q'], 'a' => $t['faq_8_a']],
                ['icon' => 'bi-geo-alt',      'q' => $t['faq_9_q'], 'a' => $t['faq_9_a']],
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
                <p class="faq-card-a"><?= strtr($f['a'], $faq_lp($base)) ?></p>
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
                ['file' => 'stetext.png',      'name' => 'ŠteteX' , 'href' => 'https://stetex-naplata-stete.rs/', 'w' => 200, 'h' => 83],
                ['file' => 'qelectronics.png', 'name' => 'Q Electronics' , 'href' => 'https://qelectronics.rs/', 'w' => 600, 'h' => 100],
                ['file' => 'gotovac.png',      'name' => 'Gotovac' , 'href' => 'https://advokatigotovac.com/', 'w' => 640, 'h' => 144],
                ['file' => 'padel.PNG',        'name' => 'Padel Pančevo' , 'href' => 'https://padelpancevo.com/', 'w' => 500, 'h' => 500],
                ['file' => 'tara.png',         'name' => 'Tara' , 'href' => 'https://taraorg.com/', 'w' => 550, 'h' => 416],
                ['file' => 'vastrener.webp',   'name' => 'Vaš Trener' , 'href' => 'http://vastrener.com/', 'w' => 350, 'h' => 309],
                ['file' => 'rakija.png',       'name' => 'Rakia Connect' , 'href' => 'https://rakia-connect.com/', 'w' => 600, 'h' => 326],
                ['file' => 'kalupizza.PNG',    'name' => 'KaluPizza' , 'href' => 'https://kalupizza.rs/', 'w' => 500, 'h' => 374],
                ['file' => 'moravka.png',      'name' => 'Pro Moravka' , 'href' => 'https://promoravka.rs/', 'w' => 500, 'h' => 500],
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
                         alt="<?= htmlspecialchars($p['name']) ?> - logo"
                         width="<?= $p['w'] ?>" height="<?= $p['h'] ?>"
                         loading="lazy" decoding="async">
                </picture>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// Kontakt sekcija je DELJENA sa landing stranicama — markup je u partialu,
// pa forma ne postoji u dve kopije. Broj sekcije ide kao parametar.
$contact_num = '07';
require __DIR__ . '/partials/contact.php';
?>

<?php require __DIR__ . '/partials/footer.php'; ?>