<?php
/**
 * VUG - „Izrada web sajta Pančevo“, JEDNOSTAVNA verzija (2026-10-26, zahtev korisnika).
 *
 * Hero + sekcija `01` („Zašto VUG“) - isti izgled kao pre proširenja iz septembra
 * 2026 (dugmad „Kontakt“ + „Pročitajte više“ u herou, „Kontaktirajte nas“ ispod
 * teksta, kartica „Naš web sajt uključuje“). BEZ usluga, procesa, delatnosti, cene,
 * recenzija, FAQ-a i kontakt forme - „Kontakt“ vodi na formu na početnoj.
 *
 * SAV tekst (uvod, pasusi, kartica, dugmad, title, description, alt) je doslovno
 * iz verzije pre proširenja - commit 5db0e85 (2026-07-28), na izričit zahtev
 * korisnika („sve da bude kao što je bilo pre dodavanja novih sekcija“), pa i
 * šablon naslova odstupa od današnjih konvencija namerno.
 * Izuzeci (korisnik, 2026-10-26): ponuda u description-u je 24h (u julu 48h), a
 * duge crte („—“) su zamenjene kratkim sa razmacima (` - `), kao na ostatku sajta.
 * Zadržane su samo nevidljive tehničke popravke (bez hreflang-a, EN noindex,
 * LCP slika bez .reveal + fetchpriority, kontrast .btn--blue, pun JSON-LD firme).
 * Ostalih 11 landing stranica i dalje opslužuje landing.php - ovaj fajl je samo
 * za ovu jednu stranicu.
 *
 * Proširena verzija je sačuvana u _arhiva/izrada-web-sajta-pancevo-2026-10-26/
 * (tamo je i uputstvo za vraćanje).
 *
 * Čisti URL-ovi (.htaccess):
 *   /izrada-web-sajta-pancevo     -> landing-web-pancevo.php
 *   /en/izrada-web-sajta-pancevo  -> landing-web-pancevo.php?lang=en
 */

$svc = 'web';
$loc = 'pancevo';

$req  = $_SERVER['REQUEST_URI'] ?? '';
$lang = (preg_match('#/en(/|$|\?)#', $req) || (($_GET['lang'] ?? '') === 'en')) ? 'en' : 'sr';
$t = require __DIR__ . '/lang/' . $lang . '.php';
require __DIR__ . '/php/icons.php';
require __DIR__ . '/php/org.php';

$SITE_URL = 'https://vugagency.com';
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

$phone_clean = preg_replace('/\s+/', '', $t['contact_info_phone']);
$phone_intl  = '+381' . ltrim($phone_clean, '0');

/* ── Sadržaj (SR/EN - ključevi moraju biti identični) ── */
$PAGE = [
    'sr' => [
        'name' => 'Pančevo',
        'crumb_home' => 'Početna',
        'badge'      => 'Digitalna agencija u Pančevu',
        'h1'         => 'Izrada web sajta {name}',
        'intro' => 'Potrebna Vam je profesionalna izrada web sajta u Pančevu? VUG kreira moderne, brze i funkcionalne sajtove po meri za preduzetnike i kompanije koje žele veću vidljivost, više upita i snažnije prisustvo na internetu.',
        'cta_contact'      => 'Kontakt',
        'cta_read'         => 'Pročitaj više',
        'cta_contact_full' => 'Kontaktirajte nas',
        'sec_eyebrow' => 'Zašto VUG',
        'sec_h2' => 'Zašto Vašem biznisu u Pančevu treba profesionalan sajt?',
        'p1' => 'Pančevo je grad u kojem posao i dalje najviše ide od preporuke i poznanstva - ali sve više kupaca prvo „proveri” firmu na internetu pre nego što pozove. Ako Vas u tom trenutku ne pronađu ili naiđu na zastareo sajt, poverenje tiho odlazi konkurenciji koja je uložila u svoje online prisustvo.',
        'p2' => '<strong>Mi smo domaća agencija - sedište nam je u Pančevu.</strong> Za dogovor Vam ne treba više od kratke šetnje ili poziva, a sve možemo rešiti i onlajn. Izrada web sajtova i web aplikacija je jedna od naših ključnih delatnosti: svaki projekat radimo posvećeno i po meri Vašeg posla, bez šablonskih rešenja koja se ne izdvajaju od drugih.',
        'p3' => 'Za lokalni biznis presudno je da se pojavi baš kad neko iz okoline traži uslugu. Zato Vaš sajt gradimo da bude <span class="lp-mark">brz</span>, pregledan i prilagođen svim mobilnim telefonima, te povezan sa Google profilom i mapama - da Vas podjednako lako nađu klijenti iz Pančeva, Srbije pa i celog sveta.',
        'p4' => 'Radimo sa klijentima iz svih delatnosti. Pre nego što napravimo prvi korak ka realizaciji projekta, prvo se dobro upoznamo sa Vašim biznisom: čime se bavite, ko su Vaši klijenti i šta želite da postignete. Tek onda gradimo sajt po meri - uz direktan razgovor, jasne rokove i cene bez skrivenih troškova - tako da rezultat nije samo još jedan web sajt na internetu, već web sajt koji će Vam donositi <strong>konkretne pozive i upite</strong>.',
        'side_h' => 'Naš web sajt <em>uključuje</em>',
        'checks' => [
            ['palette2', 'Dizajn po meri Vašeg brenda', 'Unikatan dizajn koji gradimo za Vas'],
            ['phone', 'Prilagođeno mobilnim uređajima', 'Savršen prikaz na telefonu, tabletu i računaru'],
            ['graph-up', 'Brz i lako pronalažljiv', 'Brzo učitavanje i spremnost za Google pretragu'],
            ['cash-coin', 'Napravljen da donosi upite', 'Jasni pozivi na akciju koji pretvaraju posetioce u klijente'],
            ['tools', 'Podrška nakon lansiranja', 'Tu smo za izmene, savete i održavanje'],
        ],
        'img_alt'    => 'Izrada modernog web sajta u Pančevu - VUG',
        'meta_title' => 'Izrada web sajta Pančevo - lokalna agencija za sajtove | VUG',
        'meta_desc'  => 'Izrada web sajtova u Pančevu - domaća agencija koja pravi brze i optimizovane sajtove po meri koji donose lokalne klijente. Besplatna ponuda u roku od 24h.',
        'svc_type' => 'Izrada web sajtova',
    ],
    'en' => [
        'name' => 'Pančevo',
        'crumb_home' => 'Home',
        'badge'      => 'Digital agency in Pančevo',
        'h1'         => 'Website development {name}',
        'intro' => 'Do you need professional website development in Pančevo? VUG creates modern, fast and functional custom websites for entrepreneurs and companies that want greater visibility, more enquiries and a stronger online presence.',
        'cta_contact'      => 'Contact',
        'cta_read'         => 'Read more',
        'cta_contact_full' => 'Contact us',
        'sec_eyebrow' => 'Why VUG',
        'sec_h2' => 'Why your Pančevo business needs a professional website',
        'p1' => 'In Pančevo business still grows mostly through word of mouth and personal contacts - but more and more customers now “check” a company online before they ever call. If they can’t find you at that moment, or land on an outdated site, trust quietly moves to a competitor who invested in their online presence.',
        'p2' => '<strong>We are a local agency based in Pančevo.</strong> Arranging a meeting is as easy as a short walk or a call, and we can handle everything online too. Building websites and web applications is one of our core activities: we treat every project with care and tailor it to your business, never using cookie-cutter templates that don’t stand out from the rest.',
        'p3' => 'For a local business it’s crucial to show up the very moment someone nearby searches for a service. That’s why we build your site to be <span class="lp-mark">fast</span>, clear and optimised for all mobile phones, and connected to your Google profile and maps - so clients from Pančevo, across Serbia and around the world can find you with equal ease.',
        'p4' => 'We work with clients from every industry. Before we take the first step toward your project, we first get to know your business properly: what your business is about, who your clients are and what you want to achieve. Only then do we build a tailored site - through direct conversation, clear deadlines and pricing with no hidden costs - so the result isn’t just another website on the internet, but a website that will bring you <strong>real calls and enquiries</strong>.',
        'side_h' => 'Our website <em>includes</em>',
        'checks' => [
            ['palette2', 'Design tailored to your brand', 'A unique design we build just for you'],
            ['phone', 'Optimised for mobile devices', 'Perfect on phones, tablets and desktops'],
            ['graph-up', 'Fast and easy to find', 'Fast loading and search-ready'],
            ['cash-coin', 'Built to bring enquiries', 'Clear calls to action that turn visitors into clients'],
            ['tools', 'Support after launch', 'We’re here for changes, advice and maintenance'],
        ],
        'img_alt'    => 'Modern website development in Pančevo - VUG',
        'meta_title' => 'Website development Pančevo - local web agency | VUG',
        'meta_desc'  => 'Website development in Pančevo - a local agency building fast, SEO-friendly websites that bring in local clients. Free consultation and quote within 24h.',
        'svc_type' => 'Website development',
    ],
];
$P    = $PAGE[$lang];
$NAME = $P['name'];
$H1   = strtr($P['h1'], ['{name}' => $NAME]);

/* ── URL-ovi / jezik ── */
$slug        = 'izrada-web-sajta-pancevo';
$hero_img    = 'web-mockup.svg';
$url_sr_page = $base . '/' . $slug;                 // base-aware (za linkove)
$url_en_page = $base . '/en/' . $slug;
$abs_sr      = $SITE_URL . '/' . $slug;             // apsolutni (canonical)
$abs_en      = $SITE_URL . '/en/' . $slug;

$canonical  = $lang === 'en' ? $abs_en : $abs_sr;
$href_other = $lang === 'en' ? $url_sr_page : $url_en_page;
$home       = $lang === 'en' ? $base . '/en' : ($base === '' ? '/' : $base . '/');
$og_image   = $SITE_URL . '/img/og-image.png';

// Bez hreflang-a: indeksira se samo srpska verzija, EN je noindex (partials/head.php).

/* ── SEO varijable za deljeni head ── */
$meta_title       = $P['meta_title'];
$meta_description = $P['meta_desc'];
$og_image_alt     = $P['img_alt'];
$geo_region       = 'RS-14';
$geo_placename    = $NAME;

/* ── JSON-LD: Service + WebSite + WebPage + BreadcrumbList ──
   Bez FAQPage i hasOfferCatalog - ti delovi stranice ovde ne postoje, a markup
   sme da opisuje samo ono što se vidi u HTML-u. */
$org_id  = $SITE_URL . '/#organization';
$json_ld = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Service',
            '@id' => $canonical . '#service',
            'serviceType' => $P['svc_type'],
            'name' => $H1,
            'description' => $meta_description,
            'url' => $canonical,
            // Pun lokalni profil firme iz php/org.php - isti @id kao na početnoj.
            'provider' => vug_org_schema($SITE_URL, $lang, $phone_intl),
            'areaServed' => ['@type' => 'City', 'name' => $NAME],
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
        ],
        [
            '@type' => 'WebSite',
            '@id' => $SITE_URL . '/#website',
            'url' => $SITE_URL . '/',
            'name' => VUG_BRAND_NAME,
            'alternateName' => VUG_BRAND_ALT,
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
            'publisher' => ['@id' => $org_id],
        ],
        [
            '@type' => 'WebPage', '@id' => $canonical . '#webpage', 'url' => $canonical,
            'name' => $meta_title, 'description' => $meta_description,
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
            'isPartOf' => ['@id' => $SITE_URL . '/#website'], 'about' => ['@id' => $org_id],
            'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $og_image, 'width' => 1200, 'height' => 630],
            'breadcrumb' => ['@id' => $canonical . '#breadcrumb'],
            'dateModified' => date('Y-m-d', @filemtime(__FILE__) ?: time()),
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $canonical . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => $P['crumb_home'], 'item' => $lang === 'en' ? $SITE_URL . '/en' : $SITE_URL . '/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $H1, 'item' => $canonical],
            ],
        ],
    ],
];

/* ── Konfiguracija za header/footer partiale ── */
$nav_prefix       = $home;      // sidra vode na sekcije početne (u tekućem jeziku)
$nav_current_lp   = $slug;      // stavka ove stranice u padajućoj listi „Usluge“ dobija aria-current
// Ova stranica NEMA kontakt formu - „Kontakt“ u meniju i dugmad vode na #contact POČETNE.
$contact_href     = $nav_prefix . '#contact';
$cta_href         = $nav_prefix . '#contact';
$show_lang_toggle = true;

/* ── Stil specifičan za stranicu (isti kao osnovni blok u landing.php) ── */
$extra_head = <<<'HTML'
    <style>
        .lp-hero{position:relative;padding:calc(var(--nav-h) + 60px) 0 60px;overflow:hidden;}
        .lp-hero-glow{position:absolute;top:-15%;left:60%;width:min(760px,85vw);height:520px;
            background:radial-gradient(closest-side,rgba(93,211,245,.18),rgba(79,70,152,.10) 55%,transparent 70%);
            filter:blur(20px);pointer-events:none;z-index:0;}
        .lp-hero .container{position:relative;z-index:1;}
        .lp-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:clamp(28px,5vw,64px);align-items:center;}
        @media(max-width:860px){.lp-grid{grid-template-columns:1fr;}}
        .lp-crumb{display:flex;flex-wrap:wrap;gap:8px;align-items:center;font-size:13px;color:var(--txt-muted);
            font-family:var(--ff-mono);margin-bottom:20px;}
        .lp-crumb a{color:var(--txt-muted);} .lp-crumb a:hover{color:var(--mint);} .lp-crumb span{opacity:.6;}
        .lp-badge{display:inline-flex;align-items:center;gap:9px;padding:7px 15px;border:1px solid var(--line-strong);
            border-radius:100px;font-size:13px;font-weight:600;color:var(--txt-soft);margin-bottom:22px;}
        .lp-badge .dot{width:8px;height:8px;border-radius:50%;background:var(--mint);box-shadow:0 0 12px var(--mint);}
        .lp-h1{font-size:clamp(34px,5.4vw,64px);line-height:1.03;letter-spacing:-.035em;font-weight:800;color:var(--txt);}
        .lp-h1 em{font-style:normal;
            background:linear-gradient(120deg,var(--mint),var(--cyan) 55%,var(--soft));
            -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;color:transparent;
            padding-bottom:.1em;}
        .lp-lead{font-size:clamp(16px,1.5vw,19px);line-height:1.65;color:var(--txt-soft);max-width:56ch;margin:22px 0 30px;}
        .lp-actions{display:flex;flex-wrap:wrap;gap:14px;align-items:center;}
        /* Hero slika je LCP: BEZ .reveal (opacity:0 dok main.js ne doda .in-view).
           Ulazak je samo translate (hero-rise iz critical.css), opacity ostaje 1. */
        .lp-figure{animation:hero-rise .8s .1s var(--ease) both;}
        @media(prefers-reduced-motion:reduce){.lp-figure{animation:none;}}
        .lp-figure img{width:100%;height:auto;display:block;}
        .lp-cols{display:grid;grid-template-columns:1.15fr .85fr;gap:clamp(28px,5vw,64px);align-items:start;}
        @media(max-width:860px){.lp-cols{grid-template-columns:1fr;}}
        .lp-prose p{color:var(--txt-soft);line-height:1.85;font-size:clamp(16px,1.4vw,18px);margin-top:20px;}
        .lp-prose p:first-child{margin-top:0;}
        .lp-prose strong{color:var(--txt);font-weight:700;}
        .lp-mark{color:var(--violet);font-weight:800;white-space:nowrap;}
        /* Dva brend dugmeta (nav, hero, tekst) */
        .btn--violet{background:var(--violet);color:#fff;}
        .btn--violet .vi{color:#fff;}
        .btn--violet:hover{background:var(--violet-2);transform:translateY(-2px);}
        .btn--violet:hover .vi{transform:translateX(4px);}
        .btn--cyan{background:linear-gradient(135deg,var(--cyan),var(--mint));color:var(--deep);}
        .btn--cyan .vi{color:var(--deep);}
        .btn--cyan:hover{transform:translateY(-2px);filter:brightness(1.05);}
        /* #3275b4 umesto --blue (#3b82c4): beli tekst na --blue ima kontrast 4.06:1, ispod WCAG AA 4.5:1 */
        .btn--blue{background:#3275b4;color:#fff;}
        .btn--blue .vi{color:#fff;}
        .btn--blue:hover{transform:translateY(-2px);filter:brightness(1.08);}
        .btn--blue:hover .vi{transform:translateX(4px);}
        .nav-back{display:inline-flex;align-items:center;}
        .lp-cta-line{margin-top:34px;display:flex;flex-wrap:wrap;gap:14px;align-items:center;}
        /* Mobilni: dva dugmeta po 50% širine, jedan pored drugog */
        @media(max-width:575.98px){
            .lp-actions,.lp-cta-line{gap:10px;flex-wrap:nowrap;}
            .lp-actions .btn,.lp-cta-line .btn{flex:1 1 0;min-width:0;justify-content:center;padding:13px 10px;font-size:14px;}
            .lp-cta-line{margin-top:38px;margin-bottom:12px;}
        }
        .lp-side{background:#fff;border:1px solid var(--line);border-radius:22px;overflow:hidden;
            box-shadow:0 24px 60px rgba(42,28,74,.10);}
        .lp-side-h{text-align:center;padding:18px 20px;
            background:linear-gradient(135deg,var(--bg-2) 0%,var(--deep) 55%,var(--violet) 100%);}
        .lp-side-t{font-family:var(--ff);font-weight:800;font-size:19px;letter-spacing:-.02em;color:#fff;}
        .lp-side-t em{font-style:normal;color:#fff;}
        .lp-check{list-style:none;margin:0;padding:4px 26px 20px;}
        .lp-check li{display:flex;gap:15px;align-items:center;padding:17px 0;border-top:1px solid var(--line);}
        .lp-check li:first-child{border-top:0;}
        .lp-check .lp-ic{width:44px;height:44px;flex-shrink:0;border-radius:13px;display:grid;place-items:center;
            background:linear-gradient(135deg,rgba(79,70,152,.12),rgba(93,211,245,.16));
            border:1px solid rgba(79,70,152,.16);color:var(--violet);}
        .lp-check .lp-ic .vi{width:21px;height:21px;}
        .lp-check .lp-ct{display:flex;flex-direction:column;gap:3px;}
        .lp-check .lp-ct strong{font-weight:700;color:var(--txt);font-size:16px;line-height:1.3;letter-spacing:-.01em;}
        .lp-check .lp-ct small{font-weight:500;color:var(--txt-soft);font-size:13px;line-height:1.45;}
    </style>
HTML;

require __DIR__ . '/partials/head.php';
require __DIR__ . '/partials/header.php';
?>

<!-- HERO: tekst + slika -->
<header class="lp-hero">
    <div class="lp-hero-glow" aria-hidden="true"></div>
    <div class="container">
        <div class="lp-grid">
            <div>
                <nav class="lp-crumb" aria-label="<?= $lang === 'sr' ? 'Putanja' : 'Breadcrumb' ?>">
                    <a href="<?= $home ?>"><?= htmlspecialchars($P['crumb_home']) ?></a><span>/</span>
                    <span><?= htmlspecialchars($H1) ?></span>
                </nav>
                <div class="lp-badge"><span class="dot"></span> <?= htmlspecialchars($P['badge']) ?></div>
                <h1 class="lp-h1"><?= strtr(htmlspecialchars($P['h1']), ['{name}' => '<em>' . htmlspecialchars($NAME) . '</em>']) ?></h1>
                <p class="lp-lead"><?= htmlspecialchars($P['intro']) ?></p>
                <div class="lp-actions">
                    <a href="<?= $nav_prefix ?>#contact" class="btn btn--violet is-magnetic"><?= vug_icon('chat-left-text') ?> <?= htmlspecialchars($P['cta_contact']) ?></a>
                    <a href="#tekst" class="btn btn--blue is-magnetic"><?= vug_icon('arrow-down') ?> <?= htmlspecialchars($P['cta_read']) ?></a>
                </div>
            </div>
            <div class="lp-figure">
                <!-- LCP element prvog ekrana: NE sme loading="lazy"; fetchpriority ga diže na vrh reda. -->
                <img src="<?= $base ?>/img/<?= $hero_img ?>" width="640" height="480" alt="<?= htmlspecialchars($og_image_alt) ?>" fetchpriority="high" decoding="async">
            </div>
        </div>
    </div>
</header>

<!-- TEKST (svetla pozadina za kontrast sa hero-om) -->
<!-- id="tekst" (ne "kontakt") - cilj je dugmeta "Pročitajte više", ne kontakt. -->
<section class="section section--cream" id="tekst" aria-labelledby="tekst-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>01</strong><span class="line"></span><span><?= htmlspecialchars($P['sec_eyebrow']) ?></span></div>
            <h2 class="s-title" id="tekst-title"><?= htmlspecialchars($P['sec_h2']) ?> <em>-</em></h2>
        </div>

        <div class="lp-cols reveal">
            <div class="lp-prose">
                <p><?= $P['p1'] ?></p>
                <p><?= $P['p2'] ?></p>
                <p><?= $P['p3'] ?></p>
                <p><?= $P['p4'] ?></p>
                <div class="lp-cta-line">
                    <a href="<?= $nav_prefix ?>#contact" class="btn btn--violet is-magnetic"><?= vug_icon('chat-left-text') ?> <?= htmlspecialchars($P['cta_contact_full']) ?></a>
                </div>
            </div>

            <aside class="lp-side">
                <div class="lp-side-h"><span class="lp-side-t"><?= $P['side_h'] ?></span></div>
                <ul class="lp-check">
                    <?php foreach ($P['checks'] as $ch): ?>
                    <li>
                        <span class="lp-ic"><?= vug_icon($ch[0]) ?></span>
                        <span class="lp-ct"><strong><?= htmlspecialchars($ch[1]) ?></strong><small><?= htmlspecialchars($ch[2]) ?></small></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
