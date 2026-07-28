<?php
/**
 * VUG — lokalne landing stranice za izradu web sajtova po gradovima.
 * Dvojezično (SR/EN), koristi zajednički layout: partials/head + header + footer.
 *
 * Čisti URL-ovi (.htaccess):
 *   /izrada-web-sajta-pancevo        -> landing.php?loc=pancevo
 *   /izrada-web-sajta-beograd        -> landing.php?loc=beograd
 *   /en/izrada-web-sajta-pancevo     -> landing.php?loc=pancevo&lang=en
 *   /en/izrada-web-sajta-beograd     -> landing.php?loc=beograd&lang=en
 */

$loc = $_GET['loc'] ?? 'pancevo';
if (!in_array($loc, ['pancevo', 'beograd'], true)) $loc = 'pancevo';

// Tip usluge: 'web' (izrada sajta) ili 'social' (vođenje društvenih mreža).
$svc = (($_GET['svc'] ?? 'web') === 'social') ? 'social' : 'web';

$req  = $_SERVER['REQUEST_URI'] ?? '';
$lang = (preg_match('#/en(/|$|\?)#', $req) || (($_GET['lang'] ?? '') === 'en')) ? 'en' : 'sr';
$t = require __DIR__ . '/lang/' . $lang . '.php';
require __DIR__ . '/php/icons.php';

$SITE_URL = 'https://vugagency.com';
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

$phone_clean = preg_replace('/\s+/', '', $t['contact_info_phone']);
$phone_intl  = '+381' . ltrim($phone_clean, '0');

/* ──────────────────────────────────────────────────────────────────────────
   Podaci po gradu (name = nominativ, loc = lokativ „u …”, gen = genitiv).
   VAŽNO ZA SEO: tekst (intro, naslov sekcije, pasusi, meta) je NAMERNO
   jedinstven za svaki grad — Pančevo i Beograd nemaju isti sadržaj.
   ────────────────────────────────────────────────────────────────────────── */
$CITY = [
    'pancevo' => [
        'other' => 'beograd', 'region' => 'RS-14',
        'sr' => [
            'name' => 'Pančevo', 'loc' => 'Pančevu', 'gen' => 'Pančeva',
            'intro' => 'Potrebna Vam je profesionalna izrada web sajta u Pančevu? VUG kreira moderne, brze i funkcionalne sajtove po meri za preduzetnike i kompanije koje žele veću vidljivost, više upita i snažnije prisustvo na internetu.',
            'sec_h2' => 'Zašto Vašem biznisu u Pančevu treba profesionalan sajt?',
            'p1' => 'Pančevo je grad u kojem posao i dalje najviše ide od preporuke i poznanstva — ali sve više kupaca prvo „proveri” firmu na internetu pre nego što pozove. Ako Vas u tom trenutku ne pronađu ili naiđu na zastareo sajt, poverenje tiho odlazi konkurenciji koja je uložila u svoje online prisustvo.',
            'p2' => '<strong>Mi smo domaća agencija — sedište nam je u Pančevu.</strong> Za dogovor Vam ne treba više od kratke šetnje ili poziva, a sve možemo rešiti i onlajn. Izrada web sajtova i web aplikacija je jedna od naših ključnih delatnosti: svaki projekat radimo posvećeno i po meri Vašeg posla, bez šablonskih rešenja koja se ne izdvajaju od drugih.',
            'p3' => 'Za lokalni biznis presudno je da se pojavi baš kad neko iz okoline traži uslugu. Zato Vaš sajt gradimo da bude <span class="lp-mark">brz</span>, pregledan i prilagođen svim mobilnim telefonima, te povezan sa Google profilom i mapama — da Vas podjednako lako nađu klijenti iz Pančeva, Srbije pa i celog sveta.',
            'p4' => 'Radimo sa klijentima iz svih delatnosti. Pre nego što napravimo prvi korak ka realizaciji projekta, prvo se dobro upoznamo sa Vašim biznisom: čime se bavite, ko su Vaši klijenti i šta želite da postignete. Tek onda gradimo sajt po meri — uz direktan razgovor, jasne rokove i cene bez skrivenih troškova — tako da rezultat nije samo još jedan web sajt na internetu, već web sajt koji će Vam donositi <strong>konkretne pozive i upite</strong>.',
            'meta_title' => 'Izrada web sajta Pančevo — lokalna agencija za sajtove | VUG',
            'meta_desc'  => 'Izrada web sajtova u Pančevu — domaća agencija koja pravi brze i optimizovane sajtove po meri koji donose lokalne klijente. Besplatna ponuda u roku od 48h.',
        ],
        'en' => [
            'name' => 'Pančevo', 'loc' => 'Pančevo', 'gen' => 'Pančevo',
            'intro' => 'Do you need professional website development in Pančevo? VUG creates modern, fast and functional custom websites for entrepreneurs and companies that want greater visibility, more enquiries and a stronger online presence.',
            'sec_h2' => 'Why your Pančevo business needs a professional website',
            'p1' => 'In Pančevo business still grows mostly through word of mouth and personal contacts — but more and more customers now “check” a company online before they ever call. If they can’t find you at that moment, or land on an outdated site, trust quietly moves to a competitor who invested in their online presence.',
            'p2' => '<strong>We are a local agency based in Pančevo.</strong> Arranging a meeting is as easy as a short walk or a call, and we can handle everything online too. Building websites and web applications is one of our core activities: we treat every project with care and tailor it to your business, never using cookie-cutter templates that don’t stand out from the rest.',
            'p3' => 'For a local business it’s crucial to show up the very moment someone nearby searches for a service. That’s why we build your site to be <span class="lp-mark">fast</span>, clear and optimised for all mobile phones, and connected to your Google profile and maps — so clients from Pančevo, across Serbia and around the world can find you with equal ease.',
            'p4' => 'We work with clients from every industry. Before we take the first step toward your project, we first get to know your business properly: what your business is about, who your clients are and what you want to achieve. Only then do we build a tailored site — through direct conversation, clear deadlines and pricing with no hidden costs — so the result isn’t just another website on the internet, but a website that will bring you <strong>real calls and enquiries</strong>.',
            'meta_title' => 'Website development Pančevo — local web agency | VUG',
            'meta_desc'  => 'Website development in Pančevo — a local agency building fast, SEO-friendly websites that bring in local clients. Free consultation and quote within 48h.',
        ],
    ],
    'beograd' => [
        'other' => 'pancevo', 'region' => 'RS-00',
        'sr' => [
            'name' => 'Beograd', 'loc' => 'Beogradu', 'gen' => 'Beograda',
            'intro' => 'Izrada web sajta u Beogradu koji privlači pažnju i izdvaja Vašu firmu od konkurencije. VUG kreira profesionalne, brze i SEO optimizovane sajtove osmišljene da donose više poseta, upita i novih klijenata.',
            'sec_h2' => 'Kako se izdvojiti sajtom na beogradskom tržištu?',
            'p1' => 'Beograd je najveće i najzahtevnije tržište u Srbiji — za pažnju istih kupaca svakodnevno se bori na hiljade firmi. Ovde nije dovoljno samo „imati sajt”. Ako se sporo učitava, izgleda zastarelo ili se ne pojavljuje u rezultatima pretrage, korisnik će za svega nekoliko sekundi preći na konkurenciju. Da biste zadržali njegovu pažnju, Vaše online prisustvo mora od prvog trenutka da <strong>uliva poverenje</strong>.',
            'p2' => '<strong>Tu VUG pravi razliku.</strong> Izrada web sajtova i web aplikacija jedna je od naših ključnih delatnosti, a svakom projektu pristupamo strateški. Analiziramo kome se obraćate, kako nastupa Vaša konkurencija i šta je potrebno da Vaša ponuda bude predstavljena jasnije, brže i ubedljivije. Rezultat je sajt po meri Vašeg poslovanja, osmišljen da Vas izdvoji na tržištu.',
            'p3' => 'Svaki sajt izrađujemo tako da bude <span class="lp-mark">brz</span>, pregledan i potpuno prilagođen svim uređajima. Jasna struktura vodi posetioca od prvog kontakta sa Vašim brendom do poziva, poruke ili slanja upita. Pre početka projekta detaljno se upoznajemo sa Vašim poslovanjem, ciljevima i konkurencijom, kako konačno rešenje ne bi bilo samo vizuelno privlačno, već i usmereno ka konkretnim rezultatima.',
            'p4' => 'Sarađujemo sa firmama različitih veličina i delatnosti širom Beograda. Komunikaciju vodimo brzo i profesionalno, uživo ili onlajn, uz jasno definisane rokove i transparentne cene bez skrivenih troškova. Naš cilj nije da napravimo još jedan sajt koji će se izgubiti među konkurencijom, već <strong>digitalno rešenje koje će Vam donositi konkretne upite i nove klijente</strong>.',
            'meta_title' => 'Izrada web sajta Beograd — profesionalni sajtovi | VUG',
            'meta_desc'  => 'Izrada web sajtova u Beogradu — moderni, brzi i optimizovani sajtovi koji se izdvajaju na najkonkurentnijem tržištu u Srbiji. Besplatna ponuda za 48h.',
        ],
        'en' => [
            'name' => 'Belgrade', 'loc' => 'Belgrade', 'gen' => 'Belgrade',
            'intro' => 'Website development in Belgrade that grabs attention and sets your company apart from the competition. VUG creates professional, fast and SEO‑optimised websites designed to bring more visits, enquiries and new clients.',
            'sec_h2' => 'How to stand out with a website in the Belgrade market',
            'p1' => 'Belgrade is the largest and most demanding market in Serbia — thousands of companies compete for the same customers every single day. Here it isn’t enough to simply “have a website”. If it loads slowly, looks dated or doesn’t appear in search results, the user will move on to a competitor within seconds. To hold their attention, your online presence has to <strong>inspire trust</strong> from the very first moment.',
            'p2' => '<strong>This is where VUG makes the difference.</strong> Building websites and web applications is one of our core activities, and we approach every project strategically. We analyse who you’re addressing, how your competitors present themselves and what it takes for your offer to come across more clearly, faster and more convincingly. The result is a site tailored to your business, designed to set you apart in the market.',
            'p3' => 'We build every website to be <span class="lp-mark">fast</span>, clear and fully responsive on all devices. A clear structure guides visitors from their first contact with your brand to a call, a message or an enquiry. Before the project begins we get to know your business, goals and competitors in detail, so the final solution isn’t just visually appealing but geared toward real results.',
            'p4' => 'We work with companies of different sizes and industries across Belgrade. We communicate quickly and professionally, in person or online, with clearly defined deadlines and transparent pricing with no hidden costs. Our goal isn’t to build just another site that gets lost among the competition, but a <strong>digital solution that brings you real enquiries and new clients</strong>.',
            'meta_title' => 'Website development Belgrade — custom, fast websites | VUG',
            'meta_desc'  => 'Website development in Belgrade — modern, fast, optimised websites that stand out in Serbia’s most competitive market. Free consultation and quote within 48h.',
        ],
    ],
];

/* ── Sadržaj za VOĐENJE DRUŠTVENIH MREŽA (jedinstven po gradu) ── */
$CITY_SOCIAL = [
    'pancevo' => [
        'other' => 'beograd', 'region' => 'RS-14',
        'sr' => [
            'name' => 'Pančevo', 'loc' => 'Pančevu', 'gen' => 'Pančeva',
            'intro' => 'Potrebno Vam je profesionalno vođenje društvenih mreža u Pančevu? VUG kreira sadržaj, dizajn i kampanje koje Vaš brend čine prepoznatljivim i dovode nove kupce — dok se Vi bavite svojim poslom.',
            'sec_h2' => 'Zašto Vašem biznisu u Pančevu treba prisustvo na mrežama?',
            'p1' => 'Vaši kupci u Pančevu svakodnevno provode sate na Instagramu, Facebook-u i TikTok-u. Ako Vas tamo nema — ili objavljujete neredovno i bez plana — konkurencija preuzima pažnju koja je mogla biti Vaša. Aktivan i osmišljen profil gradi poverenje i drži Vaš brend ispred pravih ljudi.',
            'p2' => '<strong>Vođenje društvenih mreža je jedna od naših ključnih delatnosti.</strong> Ne objavljujemo nasumično — pravimo strategiju: kome se obraćate, šta objavljujemo, kada i sa kojim ciljem. Vi dobijate miran san, a mreže rade za Vas.',
            'p3' => 'Za svaki profil pravimo <span class="lp-mark">mesečni content plan</span>, dizajniramo vizuale, snimamo i montiramo reels, pišemo tekstove i odgovaramo na poruke i komentare. Sve na jednom mestu, sa jasnim tonom Vašeg brenda.',
            'p4' => 'Pre nego što krenemo, upoznamo se sa Vašim poslovanjem i ciljevima. Radimo sa firmama, radnjama i lokalima iz Pančeva i okoline — uz jasne rokove, transparentne cene i mesečne izveštaje, tako da tačno vidite šta dobijate za svoj novac.',
            'meta_title' => 'Vođenje društvenih mreža Pančevo — Instagram i TikTok | VUG',
            'meta_desc'  => 'Profesionalno vođenje društvenih mreža u Pančevu — content plan, dizajn, reels i oglašavanje koji dovode kupce. Besplatna konsultacija i ponuda za 48h.',
        ],
        'en' => [
            'name' => 'Pančevo', 'loc' => 'Pančevo', 'gen' => 'Pančevo',
            'intro' => 'Need professional social media management in Pančevo? VUG creates the content, design and campaigns that make your brand recognisable and bring in new customers — while you focus on running your business.',
            'sec_h2' => 'Why your Pančevo business needs a social media presence',
            'p1' => 'Your customers in Pančevo spend hours every day on Instagram, Facebook and TikTok. If you’re not there — or you post irregularly and without a plan — competitors take the attention that could have been yours. An active, well-planned profile builds trust and keeps your brand in front of the right people.',
            'p2' => '<strong>Social media management is one of our core activities.</strong> We don’t post at random — we build a strategy: who you’re speaking to, what we post, when and with what goal. You get peace of mind while your channels work for you.',
            'p3' => 'For every profile we create a <span class="lp-mark">monthly content plan</span>, design the visuals, shoot and edit reels, write the captions and reply to messages and comments — all in one place, in your brand’s voice.',
            'p4' => 'Before we start, we get to know your business and goals. We work with companies, shops and local venues in Pančevo and the surrounding area — with clear deadlines, transparent pricing and monthly reports, so you see exactly what you get for your money.',
            'meta_title' => 'Social media management Pančevo — Instagram & TikTok | VUG',
            'meta_desc'  => 'Professional social media management in Pančevo — content plan, design, reels and ads that bring real customers. Free consultation and quote within 48h.',
        ],
    ],
    'beograd' => [
        'other' => 'pancevo', 'region' => 'RS-00',
        'sr' => [
            'name' => 'Beograd', 'loc' => 'Beogradu', 'gen' => 'Beograda',
            'intro' => 'Profesionalno vođenje društvenih mreža u Beogradu, osmišljeno da Vaš brend izdvoji na prezasićenom tržištu. VUG spaja strategiju, kvalitetan sadržaj i ciljane kampanje kako bi doneo više pratilaca, upita i prodaje.',
            'sec_h2' => 'Kako da Vaš brend postane prepoznatljiv na beogradskom tržištu?',
            'p1' => 'Beograd je najkonkurentnije tržište u Srbiji, na kojem se pažnja korisnika osvaja u prvih nekoliko sekundi. Prezasićen feed i visoka očekivanja publike znače da nasumične objave više ne donose rezultat. Za ozbiljan rast potrebni su jasna strategija, dosledan vizuelni identitet i sadržaj prilagođen pravoj publici.',
            'p2' => '<strong>Upravo tu VUG pravi razliku.</strong> Vođenje društvenih mreža jedna je od naših ključnih delatnosti, pa svakom profilu pristupamo planski — analiziramo Vašu publiku, konkurenciju i aktuelne trendove, a zatim kreiramo sadržaj koji zaustavlja skrol i gradi zajednicu oko Vašeg brenda.',
            'p3' => 'Vodimo Instagram, Facebook, TikTok i LinkedIn u celosti — od <span class="lp-mark">mesečnog content plana</span> i dizajna vizuala, preko reels-a i priča, do oglašavanja i komunikacije sa publikom. Svaka aktivnost usmerena je ka jednom cilju: da pratioce pretvorimo u kupce.',
            'p4' => 'Sarađujemo sa brendovima različitih veličina i delatnosti širom Beograda, uz jasno definisane rokove, transparentne cene i redovne mesečne izveštaje. Kao rezultat, dobijate društvene mreže koje ne služe samo za lep utisak, već <strong>donose merljive upite i prodaju</strong>.',
            'meta_title' => 'Vođenje društvenih mreža Beograd — Instagram i TikTok | VUG',
            'meta_desc'  => 'Vođenje društvenih mreža u Beogradu — strategija, sadržaj, reels i oglašavanje koji donose pratioce, upite i prodaju. Besplatna konsultacija i ponuda za 48h.',
        ],
        'en' => [
            'name' => 'Belgrade', 'loc' => 'Belgrade', 'gen' => 'Belgrade',
            'intro' => 'Professional social media management in Belgrade, designed to make your brand stand out in a saturated market. VUG combines strategy, high-quality content and targeted campaigns to bring you more followers, enquiries and sales.',
            'sec_h2' => 'How to make your brand recognisable in the Belgrade market',
            'p1' => 'Belgrade is the most competitive market in Serbia, where user attention is won in the first few seconds. A saturated feed and high audience expectations mean that random posts no longer deliver results. Serious growth requires a clear strategy, a consistent visual identity and content tailored to the right audience.',
            'p2' => '<strong>This is exactly where VUG makes the difference.</strong> Social media management is one of our core activities, so we approach every profile with a plan — we analyse your audience, competitors and current trends, then create content that stops the scroll and builds a community around your brand.',
            'p3' => 'We manage Instagram, Facebook, TikTok and LinkedIn end to end — from the <span class="lp-mark">monthly content plan</span> and visual design, through reels and stories, to advertising and audience communication. Every activity is aimed at a single goal: turning followers into customers.',
            'p4' => 'We work with brands of different sizes and industries across Belgrade, with clearly defined deadlines, transparent pricing and regular monthly reports. As a result, you get social channels that aren’t just for a good impression but <strong>deliver measurable enquiries and sales</strong>.',
            'meta_title' => 'Social media management Belgrade — Instagram & TikTok | VUG',
            'meta_desc'  => 'Social media management in Belgrade — strategy, content, reels and ads that bring followers, enquiries and sales. Free consultation and quote within 48h.',
        ],
    ],
];
if ($svc === 'social') $CITY = $CITY_SOCIAL;

$cc   = $CITY[$loc];
$c    = $cc[$lang];
$NAME = $c['name'];
$LOCW = $c['loc'];
$GEN  = $c['gen'];

// Zamena tokena {name}/{loc}/{gen} u zajedničkom (ne-gradskom) copy-ju.
$fill = function ($s) use ($NAME, $LOCW, $GEN) {
    return strtr($s, ['{name}' => $NAME, '{loc}' => $LOCW, '{gen}' => $GEN]);
};

/* ── Zajednički copy (isti okvir za sve gradove; jedinstven tekst je u $CITY) ── */
$COPY = [
    'sr' => [
        'crumb_home' => 'Početna',
        'badge'      => 'Digitalna agencija u {loc}',
        'h1'         => 'Izrada web sajta {name}',
        'cta_contact'=> 'Kontakt',
        'cta_contact_full' => 'Kontaktirajte nas',
        'cta_home'   => 'Početna',
        'cta_read'   => 'Pročitaj više',
        'sec_eyebrow'=> 'Zašto VUG',
        'side_h' => 'Naš web sajt <em>uključuje</em>',
        'checks' => [
            ['palette2', 'Dizajn po meri Vašeg brenda', 'Unikatan dizajn koji gradimo za Vas'],
            ['phone', 'Prilagođeno mobilnim uređajima', 'Savršen prikaz na telefonu, tabletu i računaru'],
            ['graph-up', 'Brz i lako pronalažljiv', 'Brzo učitavanje i spremnost za Google pretragu'],
            ['cash-coin', 'Napravljen da donosi upite', 'Jasni pozivi na akciju koji pretvaraju posetioce u klijente'],
            ['tools', 'Podrška nakon lansiranja', 'Tu smo za izmene, savete i održavanje'],
        ],
        'img_alt'  => 'Izrada modernog web sajta u {loc} — VUG',
        'meta_kw'  => 'izrada web sajta {name}, izrada sajtova {name}, web dizajn {name}, izrada web aplikacija {name}, digitalna agencija {name}',
        'svc_type' => 'Izrada web sajtova',
        'svc_name' => 'Izrada web sajta {name}',
    ],
    'en' => [
        'crumb_home' => 'Home',
        'badge'      => 'Digital agency in {loc}',
        'h1'         => 'Website development {name}',
        'cta_contact'=> 'Contact',
        'cta_contact_full' => 'Contact us',
        'cta_home'   => 'Home',
        'cta_read'   => 'Read more',
        'sec_eyebrow'=> 'Why VUG',
        'side_h' => 'Our website <em>includes</em>',
        'checks' => [
            ['palette2', 'Design tailored to your brand', 'A unique design we build just for you'],
            ['phone', 'Optimised for mobile devices', 'Perfect on phones, tablets and desktops'],
            ['graph-up', 'Fast and easy to find', 'Fast loading and search-ready'],
            ['cash-coin', 'Built to bring enquiries', 'Clear calls to action that turn visitors into clients'],
            ['tools', 'Support after launch', 'We’re here for changes, advice and maintenance'],
        ],
        'img_alt'  => 'Modern website development in {loc} — VUG',
        'meta_kw'  => 'website development {name}, web design {name}, web development {name}, web application development {name}, digital agency {name}',
        'svc_type' => 'Website development',
        'svc_name' => 'Website development {name}',
    ],
];
/* ── Chrome za VOĐENJE DRUŠTVENIH MREŽA ── */
$COPY_SOCIAL = [
    'sr' => [
        'crumb_home' => 'Početna',
        'badge'      => 'Digitalna agencija u {loc}',
        'h1'         => 'Vođenje društvenih mreža {name}',
        'cta_contact'=> 'Kontakt',
        'cta_contact_full' => 'Kontaktirajte nas',
        'cta_home'   => 'Početna',
        'cta_read'   => 'Pročitaj više',
        'sec_eyebrow'=> 'Zašto VUG',
        'side_h' => 'Vođenje mreža <em>uključuje</em>',
        'checks' => [
            ['tag', 'Content plan i objave', 'Mesečni plan sadržaja i redovno objavljivanje'],
            ['palette2', 'Dizajn vizuala', 'Grafika, priče i reels koji privlače pažnju'],
            ['chat-dots', 'Community management', 'Odgovaramo na poruke i komentare umesto Vas'],
            ['cash-coin', 'Oglašavanje (Meta Ads)', 'Ciljane kampanje koje dovode kupce, ne samo lajkove'],
            ['graph-up', 'Mesečni izveštaji', 'Jasni rezultati i preporuke za sledeći korak'],
        ],
        'img_alt'  => 'Vođenje društvenih mreža u {loc} — VUG',
        'meta_kw'  => 'vođenje društvenih mreža {name}, društvene mreže {name}, instagram {name}, marketing na mrežama {name}, digitalna agencija {name}',
        'svc_type' => 'Vođenje društvenih mreža',
        'svc_name' => 'Vođenje društvenih mreža {name}',
    ],
    'en' => [
        'crumb_home' => 'Home',
        'badge'      => 'Digital agency in {loc}',
        'h1'         => 'Social media management {name}',
        'cta_contact'=> 'Contact',
        'cta_contact_full' => 'Contact us',
        'cta_home'   => 'Home',
        'cta_read'   => 'Read more',
        'sec_eyebrow'=> 'Why VUG',
        'side_h' => 'Social media management <em>includes</em>',
        'checks' => [
            ['tag', 'Content plan & posting', 'A monthly content plan and consistent posting'],
            ['palette2', 'Visual design', 'Graphics, stories and reels that grab attention'],
            ['chat-dots', 'Community management', 'We reply to messages and comments for you'],
            ['cash-coin', 'Advertising (Meta Ads)', 'Targeted campaigns that bring customers, not just likes'],
            ['graph-up', 'Monthly reports', 'Clear results and recommendations for the next step'],
        ],
        'img_alt'  => 'Social media management in {loc} — VUG',
        'meta_kw'  => 'social media management {name}, social media marketing {name}, instagram {name}, facebook {name}, digital agency {name}',
        'svc_type' => 'Social media management',
        'svc_name' => 'Social media management {name}',
    ],
];
if ($svc === 'social') $COPY = $COPY_SOCIAL;

$P = $COPY[$lang];

/* ── URL-ovi / jezik ── */
$slug_base   = $svc === 'social' ? 'vodjenje-drustvenih-mreza-' : 'izrada-web-sajta-';
$hero_img    = $svc === 'social' ? 'social-mockup.svg' : 'web-mockup.svg';
$slug        = $slug_base . $loc;
$url_sr_page = ($base === '' ? '' : $base) . '/' . $slug;              // base-aware (za linkove)
$url_en_page = $base . '/en/' . $slug;
$abs_sr      = $SITE_URL . '/' . $slug;                                 // apsolutni (canonical/hreflang)
$abs_en      = $SITE_URL . '/en/' . $slug;

$canonical  = $lang === 'en' ? $abs_en : $abs_sr;
$href_other = $lang === 'en' ? $url_sr_page : $url_en_page;
$home       = $lang === 'en' ? $base . '/en' : ($base === '' ? '/' : $base . '/');
$og_image   = $SITE_URL . '/img/og-image.png';

$alt_links = [
    ['hreflang' => 'sr-RS',     'href' => $abs_sr],
    ['hreflang' => 'en',        'href' => $abs_en],
    ['hreflang' => 'x-default', 'href' => $abs_sr],
];

/* ── SEO varijable za deljeni head ── */
$meta_title       = $c['meta_title'];
$meta_description = $c['meta_desc'];
$meta_keywords    = $fill($P['meta_kw']);
$og_image_alt     = $fill($P['img_alt']);
$geo_region       = $cc['region'];
$geo_placename    = $NAME;

/* ── JSON-LD: Service + WebPage + BreadcrumbList ── */
$org_id  = $SITE_URL . '/#organization';
$json_ld = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Service',
            '@id' => $canonical . '#service',
            'serviceType' => $P['svc_type'],
            'name' => $fill($P['svc_name']),
            'description' => $meta_description,
            'url' => $canonical,
            'provider' => [
                '@type' => ['Organization', 'ProfessionalService'],
                '@id' => $org_id, 'name' => 'VUG', 'url' => $SITE_URL . '/',
                'telephone' => $phone_intl,
                'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Vojvođanska 12b',
                    'addressLocality' => 'Pančevo', 'postalCode' => '26000', 'addressCountry' => 'RS'],
            ],
            'areaServed' => ['@type' => 'City', 'name' => $NAME],
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
        ],
        [
            '@type' => 'WebPage', '@id' => $canonical . '#webpage', 'url' => $canonical,
            'name' => $meta_title, 'description' => $meta_description,
            'inLanguage' => $lang === 'sr' ? 'sr-RS' : 'en',
            'isPartOf' => ['@id' => $SITE_URL . '/#website'], 'about' => ['@id' => $org_id],
            'primaryImageOfPage' => $og_image,
            'dateModified' => date('Y-m-d', @filemtime(__FILE__) ?: time()),
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => $P['crumb_home'], 'item' => $lang === 'en' ? $SITE_URL . '/en' : $SITE_URL . '/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $fill($P['h1']), 'item' => $canonical],
            ],
        ],
    ],
];

/* ── Konfiguracija za header/footer partiale ── */
$nav_prefix       = $home;      // sidra vode na sekcije početne (u tekućem jeziku)
$contact_href     = '#kontakt'; // "Kontakt" (meni) -> lokalna sekcija
$cta_href         = '#kontakt';
$show_lang_toggle = true;

/* ── Stil specifičan za stranicu ── */
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
        .btn--blue{background:var(--blue);color:#fff;}
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
                    <span><?= htmlspecialchars($fill($P['h1'])) ?></span>
                </nav>
                <div class="lp-badge"><span class="dot"></span> <?= htmlspecialchars($fill($P['badge'])) ?></div>
                <h1 class="lp-h1"><?= strtr(htmlspecialchars($P['h1']), ['{name}' => '<em>' . htmlspecialchars($NAME) . '</em>']) ?></h1>
                <p class="lp-lead"><?= htmlspecialchars($c['intro']) ?></p>
                <div class="lp-actions">
                    <a href="<?= $nav_prefix ?>#contact" class="btn btn--violet is-magnetic"><?= vug_icon('chat-left-text') ?> <?= htmlspecialchars($P['cta_contact']) ?></a>
                    <a href="#kontakt" class="btn btn--blue is-magnetic"><?= vug_icon('arrow-down') ?> <?= htmlspecialchars($P['cta_read']) ?></a>
                </div>
            </div>
            <div class="lp-figure reveal">
                <img src="<?= $base ?>/img/<?= $hero_img ?>" width="640" height="480" alt="<?= htmlspecialchars($og_image_alt) ?>">
            </div>
        </div>
    </div>
</header>

<!-- TEKST (svetla pozadina za kontrast sa hero-om) -->
<section class="section section--cream" id="kontakt" aria-labelledby="tekst-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>01</strong><span class="line"></span><span><?= htmlspecialchars($P['sec_eyebrow']) ?></span></div>
            <h2 class="s-title" id="tekst-title"><?= htmlspecialchars($c['sec_h2']) ?> <em>—</em></h2>
        </div>

        <div class="lp-cols reveal">
            <div class="lp-prose">
                <p><?= $c['p1'] ?></p>
                <p><?= $c['p2'] ?></p>
                <p><?= $c['p3'] ?></p>
                <p><?= $c['p4'] ?></p>
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
