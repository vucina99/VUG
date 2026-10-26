<?php
/**
 * VUG - prošireni sadržaj lokalnih landing stranica (landing.php).
 *
 * ZAŠTO ZASEBAN FAJL: ovo je strukturiran sadržaj (kao php/projects.php i
 * legal.php), a ne UI copy, pa ne ide u lang/*.php. landing.php ostaje
 * kontroler + prikaz; sav dugi tekst po gradu/usluzi/jeziku živi ovde.
 *
 * STRUKTURA:
 *   'ui'   => [ <svc> => [ <lang> => [ labele okvira; tokeni {name}/{loc}/{gen} ] ] ]
 *   'city' => [ <svc> => [ <loc> => [ <lang> => [ jedinstven tekst ] ] ] ]
 *
 * SEO PRAVILO: tekst po gradu MORA biti jedinstven (Google lokalne landing
 * stranice sa istim tekstom tretira kao doorway stranice). Okvir (labele,
 * eyebrow-i, dugmad) se deli; sve što nosi značenje piše se posebno za svaki
 * grad. Isto važi i za engleske verzije.
 *
 * `area_served` NIJE prikaz - puni samo `areaServed` u JSON-LD grafu.
 *
 * KOJE SEKCIJE SE PRIKAZUJU: landing.php renderuje sekciju samo ako za taj
 * grad/uslugu postoji odgovarajući ključ (npr. 'serv', 'proc', 'ind', 'price',
 * 'rev', 'faq', 'local'). 'rev' => true uključuje sekciju „Šta kažu klijenti“ -
 * istu traku sa svim recenzijama kao na početnoj (partials/testimonials.php). Zato 'social' trenutno ima samo FAQ + lokalni blok, a 'web'
 * pun set - dodavanjem ključa sekcija se pojavi sama, bez izmene prikaza.
 *
 * Ključevi u 'sr' i 'en' MORAJU biti identični (isti princip kao lang/*.php).
 */

return [

/* ══════════════════════════════════════════════════════════════════════════
   OKVIR (labele) - deli se između gradova; tokeni {name}/{loc}/{gen}
   ══════════════════════════════════════════════════════════════════════════ */
'ui' => [

'web' => [
    'sr' => [
        'serv_eyebrow'   => 'Usluge',
        'proc_eyebrow'   => 'Kako radimo',
        'ind_eyebrow'    => 'Za koga radimo',
        'price_eyebrow'  => 'Cena',
        'faq_eyebrow'    => 'Česta pitanja',
        'price_note_h'   => 'Kako dolazimo do ponude',
        'cta_primary'    => 'Zatražite besplatnu ponudu',
        'cta_phone'      => 'Pozovite odmah',
    ],
    'en' => [
        'serv_eyebrow'   => 'Services',
        'proc_eyebrow'   => 'How we work',
        'ind_eyebrow'    => 'Who we work with',
        'price_eyebrow'  => 'Pricing',
        'faq_eyebrow'    => 'FAQ',
        'price_note_h'   => 'How we arrive at a quote',
        'cta_primary'    => 'Request a free quote',
        'cta_phone'      => 'Call us now',
    ],
],

'social' => [
    'sr' => [
        'serv_eyebrow'   => 'Usluge',
        'proc_eyebrow'   => 'Kako radimo',
        'ind_eyebrow'    => 'Za koga radimo',
        'price_eyebrow'  => 'Cena',
        'faq_eyebrow'    => 'Česta pitanja',
        'price_note_h'   => 'Kako dolazimo do ponude',
        'cta_primary'    => 'Zatražite besplatnu ponudu',
        'cta_phone'      => 'Pozovite odmah',
    ],
    'en' => [
        'serv_eyebrow'   => 'Services',
        'proc_eyebrow'   => 'How we work',
        'ind_eyebrow'    => 'Who we work with',
        'price_eyebrow'  => 'Pricing',
        'faq_eyebrow'    => 'FAQ',
        'price_note_h'   => 'How we arrive at a quote',
        'cta_primary'    => 'Request a free quote',
        'cta_phone'      => 'Call us now',
    ],
],

'marketing' => [
    'sr' => [
        'serv_eyebrow'   => 'Usluge',
        'proc_eyebrow'   => 'Kako radimo',
        'ind_eyebrow'    => 'Za koga radimo',
        'price_eyebrow'  => 'Cena',
        'faq_eyebrow'    => 'Česta pitanja',
        'price_note_h'   => 'Kako dolazimo do ponude',
        'cta_primary'    => 'Zatražite besplatnu ponudu',
        'cta_phone'      => 'Pozovite odmah',
    ],
    'en' => [
        'serv_eyebrow'   => 'Services',
        'proc_eyebrow'   => 'How we work',
        'ind_eyebrow'    => 'Who we work with',
        'price_eyebrow'  => 'Pricing',
        'faq_eyebrow'    => 'FAQ',
        'price_note_h'   => 'How we arrive at a quote',
        'cta_primary'    => 'Request a free quote',
        'cta_phone'      => 'Call us now',
    ],
],

], /* end ui */

/* ══════════════════════════════════════════════════════════════════════════
   SADRŽAJ PO GRADU - jedinstven tekst
   ══════════════════════════════════════════════════════════════════════════ */
'city' => [

/* ────────────────────────────────────────────────────────────────────────────
   IZRADA WEB SAJTA
   ──────────────────────────────────────────────────────────────────────────── */
'web' => [

/* ═══ PANČEVO ═══ */
'pancevo' => [
'sr' => [

'serv_h2'   => 'Šta sve radimo za klijente u Pančevu <em>-</em>',
'serv_lead' => 'Od prvog razgovora do finalne realizacije sajta, kompletan proces vodimo interno, uz jasno definisane uloge, direktnu komunikaciju i potpunu kontrolu nad svakom fazom projekta.',
'serv' => [
    ['code-slash',   'Sajtovi i web aplikacije',    'Prezentacioni sajt, katalog ili web aplikacija po meri Vašeg posla. Pišemo ih od nule, bez kupljenih tema koje usporavaju učitavanje i liče jedna na drugu.'],
    ['cart',         'Online prodavnice',           'Web shop prilagođen domaćem kupcu - plaćanje pouzećem i karticom, obračun dostave, kuponi i pregledna administracija koju možete sami da vodite.'],
    ['arrow-repeat', 'Redizajn postojećeg sajta',   'Ako sajt radi ali izgleda zastarelo, zadržavamo sadržaj i pozicije u pretrazi, a menjamo dizajn, brzinu i strukturu - bez pada saobraćaja posle prelaska.'],
    ['search',       'SEO optimizacija',            'Tehnička osnova, lokalne ključne reči i povezivanje sa Google poslovnim profilom - da Vas nađu baš onda kada neko traži uslugu koju nudite.'],
    ['tools',        'Održavanje i podrška',        'Nadogradnje, izmene sadržaja, rezervne kopije i bezbednost. Sajt ostaje brz i siguran i mesecima posle lansiranja, a Vi imate kome da se javite za svako pitanje.'],
    ['palette2',     'Brending i grafički dizajn',  'Logo, boje, tipografija i materijali koji sajtu daju prepoznatljiv identitet - isti utisak na ekranu, na izlogu i u štampi.'],
],

'proc_h2'   => 'Kako izgleda saradnja od poziva do lansiranja <em>-</em>',
'proc_lead' => 'Četiri koraka, jasno definisani rokovi i jedna osoba koja Vas vodi kroz ceo proces. Prvi sastanak možemo organizovati uživo ili online, ali preporučujemo uživo kako bismo bolje upoznali Vas, Vaš biznis i ciljeve.',
'proc' => [
    ['Razgovor i analiza',    'Upoznajemo se sa Vašim poslom: čime se bavite, ko su Vaši kupci, kako do Vas dolaze danas i šta želite da se promeni. Istražimo konkurenciju i njihov rad.'],
    ['Plan i struktura',      'Definišemo stranice, dizajn, redosled sadržaja i put posetioca do poziva ili upita. Vi dobijate pisanu ponudu sa fiksnom cenom, rokom i tačnim spiskom onoga što ulazi u posao.'],
    ['Izrada i testiranje',   'Sajt se kodira, puni sadržajem i proverava na telefonu, tabletu i računaru, u svim čestim pretraživačima. Merimo brzinu učitavanja i ispravljamo sve što ga usporava.'],
    ['Lansiranje i podrška',  'Postavljamo sajt na domen, povezujemo Google Analytics, Search Console i poslovni profil, i pokazujemo Vam kako da upravljate svojim web sajtom. Posle toga ostajemo dostupni.'],
],

'ind_h2'   => 'Za koga pravimo sajtove u Pančevu <em>-</em>',
'ind_lead' => 'Ne ograničavamo se na jednu industriju. Naš pristup prilagođavamo svakom poslovanju koje želi veću vidljivost i bolje prisustvo na tržištu. Ovo su delatnosti sa kojima najčešće sarađujemo u Pančevu i južnom Banatu.',
'ind' => [
    'Zanatske radnje i servisi',
    'Stomatološke i lekarske ordinacije',
    'Restorani, kafići i dostava hrane',
    'Auto-servisi i auto-placevi',
    'Građevina i izvođački radovi',
    'Transport i logistika',
    'Frizerski i kozmetički saloni',
    'Teretane i sportski klubovi',
    'Advokati, knjigovođe i agencije',
    'Poljoprivreda, otkup i mehanizacija',
    'Proizvodnja i veleprodaja',
    'Privatne škole, vrtići i kursevi',
],

'price_h2'   => 'Koliko košta izrada web sajta u Pančevu <em>-</em>',
'price_lead' => 'Pošten odgovor je: zavisi od toga šta sajt treba da radi. Umesto cifre „od oka“, evo pet stvari koje najviše utiču na cenu - da znate na čemu se gradi ponuda koju dobijate.',
'price' => [
    ['Obim sajta',              'Jednostrana prezentacija i sajt sa dvadeset podstranica nisu isti posao. Broj stranica, jezika i tipova sadržaja je prva stavka u svakoj ponudi.'],
    ['Dizajn po meri',          'Cena zavisi od kompleksnosti dizajna i elemenata koji se izrađuju posebno za Vaš brend. Što je dizajn detaljniji i individualniji, potrebno je više vremena za njegovu izradu i implementaciju.'],
    ['Funkcionalnosti',         'Prodavnica, online rezervacije, kalkulator cena, korisnički nalozi, povezivanje sa Vašim programom za fakturisanje - svaka od njih je zaseban deo posla.'],
    ['Sadržaj',                 'Ako imate spremne tekstove i fotografije, idemo brže. Ako nemate, pišemo tekstove i pripremamo vizuale, pa se to obračunava posebno.'],
    ['Šta ide posle lansiranja','Hosting, domen i budžet za oglašavanje ne ulaze u našu naknadu - plaćate ih direktno provajderu kod kog ih uzimate. Okvirne iznose za te stavke dobijate unapred, uz ponudu.'],
],
'price_note' => 'Ne naplaćujemo „po satu, videćemo koliko ispadne“. Posle kratkog razgovora - telefonom ili uživo - dobijate pisanu ponudu sa fiksnom cenom, rokom i tačnim spiskom onoga što ulazi u posao. Ponuda stiže u roku od 24 sata, besplatna je i ne stvara nikakve obaveze prema nama.',

'rev' => true,   // sekcija „Šta kažu klijenti“ (partials/testimonials.php)

'faq_h2'   => 'Česta pitanja o izradi sajta u Pančevu <em>-</em>',
'faq_lead' => 'Pitanja koja nam klijenti iz Pančeva postavljaju na prvom sastanku. Ako Vaše nije na spisku, javite se - odgovaramo istog dana.',
'faq' => [
    ['star-fill',      'Zašto izabrati VUG za izradu web sajta u Pančevu?',
                       'VUG Digital Agency nudi profesionalnu izradu web sajtova u Pančevu, uz individualan pristup, direktnu komunikaciju i transparentne uslove saradnje. Svaki sajt je namenski kodiran, optimizovan za brzinu i Google pretragu, uz mogućnost nadogradnje novim funkcionalnostima u skladu sa rastom i potrebama Vašeg poslovanja. Ako uz sajt želite i aktivne profile, isti tim radi i <a href="{lp_social_pancevo}">vođenje društvenih mreža u Pančevu</a> - pa sajt i mreže govore istim jezikom.'],
    ['briefcase',      'Koliko košta izrada web sajta u Pančevu?',
                       'Cena zavisi od obima: broja stranica, da li je dizajn po meri ili prilagođen, i da li sajt ima prodavnicu, rezervacije ili druge funkcionalnosti. Zato ne objavljujemo cenovnik „od“ - posle kratkog razgovora dobijate <strong>pisanu ponudu sa fiksnom cenom i rokom</strong>, bez skrivenih troškova. Procena stiže u roku od 24 sata i ne obavezuje Vas.'],
    ['clock',          'Koliko traje izrada sajta?',
                       'Prezentacioni sajt srednjeg obima najčešće je gotov za <strong>8 do 12 dana</strong>, a online prodavnice i web aplikacije mogu i duže, u zavisnosti od funkcionalnosti. Najveći deo roka zavisi od toga koliko brzo dobijemo tekstove, fotografije i Vaše odobrenje na dizajn - zato rok dogovaramo zajedno na početku i držimo ga se.'],
    ['check2-circle',  'Šta mi je potrebno da bismo počeli?',
                       'Za prvi razgovor ne treba ništa - dovoljno je da nam ispričate čime se bavite i šta želite da postignete. Kasnije nam trebaju osnovne informacije o uslugama, kontakt podaci i, ako imate, logo i fotografije. Ako nemate ništa od toga, <strong>pišemo tekstove i pripremamo vizuale umesto Vas</strong>.'],
    ['search',         'Da li ću se pojaviti na Google pretrazi?',
                       'Sajt gradimo tako da bude tehnički spreman za pretragu: brz, sa ispravnom strukturom naslova, opisima stranica, mapom sajta i povezan sa Google Search Console-om i poslovnim profilom. To je osnova bez koje se ne može. <strong>Ozbiljne pozicije na konkurentnim pojmovima traže vreme i kontinuiran rad</strong> - to je zasebna, mesečna usluga o kojoj otvoreno razgovaramo, bez obećanja „prvo mesto za sedam dana“.'],
    ['arrow-repeat',   'Da li radite redizajn postojećeg sajta?',
                       'Radimo, i to je čest posao. Kod redizajna pazimo da <strong>ne izgubite pozicije koje već imate</strong>: prenosimo sadržaj, zadržavamo adrese stranica ili postavljamo preusmerenja, i tek onda menjamo dizajn, brzinu i strukturu. Pre početka Vam kažemo šta na sadašnjem sajtu vredi zadržati, a šta ne.'],
    ['person',         'Ko je vlasnik sajta, domena i hostinga?',
                       'Vi. Domen i hosting se registruju <strong>na Vaše ime i Vašu firmu</strong>, a pristupne podatke dobijate po lansiranju. Sajt je Vaše vlasništvo i u svakom trenutku možete da ga prenesete kome želite - ne držimo klijente „zaključane“ kod sebe.'],
    ['phone',          'Da li sajt radi na mobilnom telefonu?',
                       'Radi, i to je prioritet, a ne dodatak. Veći deo posetilaca lokalnim sajtovima dolazi sa telefona, pa <strong>svaku stranicu prvo proveravamo na telefonu</strong>, pa onda na tabletu i računaru. Broj telefona je na dodir, mape se otvaraju u jednom kliku, a kontakt forma se popunjava lako i prilagođena je posetiocima sajta.'],
],

'area_served' => ['Pančevo', 'Starčevo', 'Omoljica', 'Jabuka', 'Kačarevo', 'Dolovo', 'Opovo', 'Kovačica', 'Kovin', 'Alibunar', 'Vršac', 'Južnobanatski okrug', 'Beograd', 'Srbija'],
],

'en' => [

'serv_h2'   => 'What we do for clients in Pančevo <em>-</em>',
'serv_lead' => 'From the first conversation to the finished website, we run the entire process in-house, with clearly defined roles, direct communication and full control over every phase of the project.',
'serv' => [
    ['code-slash',   'Websites and web applications', 'A brochure site, a catalogue or a web application tailored to your business. We write them from scratch, with no bought themes that slow things down and look like everyone else.'],
    ['cart',         'Online shops',                 'A web shop adapted to the local buyer - cash on delivery and card payments, shipping calculation, coupons and a clear admin panel you can run yourself.'],
    ['arrow-repeat', 'Redesign of an existing site',  'If your site works but looks dated, we keep the content and your search positions and change the design, the speed and the structure - with no traffic drop after the switch.'],
    ['search',       'SEO optimisation',              'A technical foundation, local keywords and a connected Google Business Profile - so people find you exactly when someone searches for what you offer.'],
    ['tools',        'Maintenance and support',       'Updates, content changes, backups and security. The site stays fast and safe months after launch, and you always have someone to call with any question.'],
    ['palette2',     'Branding and graphic design',   'Logo, colours, typography and materials that give the site a recognisable identity - the same impression on screen, on your shopfront and in print.'],
],

'proc_h2'   => 'What the project looks like, from call to launch <em>-</em>',
'proc_lead' => 'Four steps, clearly defined deadlines and one person who guides you through the whole process. The first meeting can be in person or online, but we recommend in person so we can get to know you, your business and your goals properly.',
'proc' => [
    ['Conversation and analysis', 'We get to know your business: what you do, who your customers are, how they reach you today and what you want to change. We research the competition and how they work.'],
    ['Plan and structure',        'We define the pages, the design, the order of the content and the visitor’s path to a call or an enquiry. You receive a written quote with a fixed price, a deadline and an exact list of what the job includes.'],
    ['Build and testing',         'The site is coded, filled with content and checked on phones, tablets and desktops, in every common browser. We measure loading speed and fix everything that slows it down.'],
    ['Launch and support',        'We put the site on your domain, connect Google Analytics, Search Console and your business profile, and show you how to manage your website yourself. After that we stay available.'],
],

'ind_h2'   => 'Who we build websites for in Pančevo <em>-</em>',
'ind_lead' => 'We don’t limit ourselves to a single industry. We adapt our approach to every business that wants greater visibility and a stronger presence in its market. These are the industries we work with most often in Pančevo and South Banat.',
'ind' => [
    'Trades and repair shops',
    'Dental and medical practices',
    'Restaurants, cafés and food delivery',
    'Car services and dealerships',
    'Construction and contracting',
    'Transport and logistics',
    'Hair and beauty salons',
    'Gyms and sports clubs',
    'Lawyers, accountants and agencies',
    'Agriculture, produce buying and machinery',
    'Manufacturing and wholesale',
    'Private schools, nurseries and courses',
],

'price_h2'   => 'How much does a website in Pančevo cost <em>-</em>',
'price_lead' => 'The honest answer is: it depends on what the site has to do. Instead of a number pulled out of thin air, here are the five things that affect the price most - so you know what the quote you receive is built on.',
'price' => [
    ['Scope of the site',   'A one-page presentation and a site with twenty subpages are not the same job. The number of pages, languages and content types is the first item in every quote.'],
    ['Custom design',       'The price depends on the complexity of the design and on the elements built specifically for your brand. The more detailed and individual the design, the more time it takes to create and implement.'],
    ['Functionality',       'A store, online booking, a price calculator, user accounts, a connection to your invoicing software - each of these is a separate part of the job.'],
    ['Content',             'If your texts and photos are ready, we move faster. If they aren’t, we write the copy and prepare the visuals, and that is quoted separately.'],
    ['What comes after launch', 'Hosting, the domain and the advertising budget are not included in our fee - you pay them directly to the provider you get them from. You receive the approximate amounts for those items in advance, with the quote.'],
],
'price_note' => 'We don’t charge “by the hour, we’ll see how it turns out”. After a short conversation - by phone or in person - you receive a written quote with a fixed price, a deadline and an exact list of what the job includes. The quote arrives within 24 hours, is free of charge and creates no obligation towards us.',

'rev' => true,

'faq_h2'   => 'Frequently asked questions about websites in Pančevo <em>-</em>',
'faq_lead' => 'The questions clients from Pančevo ask us at the first meeting. If yours isn’t on the list, get in touch - we reply the same day.',
'faq' => [
    ['star-fill',      'Why choose VUG for website development in Pančevo?',
                       'VUG Digital Agency offers professional website development in Pančevo, with an individual approach, direct communication and transparent terms of cooperation. Every site is purpose-built in code, optimised for speed and Google Search, with the option to add new functionality as your business grows and its needs change. If you want active social profiles alongside the site, the same team also handles <a href="{lp_social_pancevo}">social media management in Pančevo</a> - so your website and channels speak with one voice.'],
    ['briefcase',      'How much does a website in Pančevo cost?',
                       'The price depends on the scope: the number of pages, whether the design is custom or adapted, and whether the site has a store, booking or other functionality. That is why we don’t publish a “starting from” price list - after a short conversation you receive a <strong>written quote with a fixed price and deadline</strong>, with no hidden costs. The estimate arrives within 24 hours and commits you to nothing.'],
    ['clock',          'How long does it take to build a website?',
                       'A mid-sized brochure site is usually finished in <strong>8 to 12 days</strong>, while online stores and web applications can take longer, depending on the functionality. Most of the timeline depends on how quickly we receive your texts, photos and your approval of the design - which is why we agree the deadline together at the start and stick to it.'],
    ['check2-circle',  'What do I need to get started?',
                       'For the first conversation, nothing - just tell us what you do and what you want to achieve. Later we need basic information about your services, your contact details and, if you have them, a logo and photos. If you have none of that, <strong>we write the copy and prepare the visuals for you</strong>.'],
    ['search',         'Will I appear in Google search?',
                       'We build the site to be technically ready for search: fast, with a correct heading structure, page descriptions, a sitemap, and connected to Google Search Console and your business profile. That is the foundation you cannot skip. <strong>Serious rankings on competitive terms take time and continuous work</strong> - that is a separate monthly service we discuss openly, with no “first place in seven days” promises.'],
    ['arrow-repeat',   'Do you redesign existing websites?',
                       'We do, and it is a common job. With a redesign we make sure you <strong>don’t lose the positions you already have</strong>: we migrate the content, keep the page addresses or set up redirects, and only then change the design, the speed and the structure. Before we start we tell you what on your current site is worth keeping and what isn’t.'],
    ['person',         'Who owns the site, the domain and the hosting?',
                       'You do. The domain and hosting are registered <strong>in your name and your company’s name</strong>, and you receive the access details at launch. The site is your property and you can move it to anyone you like at any time - we don’t keep clients locked in.'],
    ['phone',          'Does the site work on mobile phones?',
                       'It does, and that is a priority rather than an add-on. Most visitors to local websites arrive from a phone, so <strong>we check every page on a phone first</strong>, then on tablet and desktop. The phone number is tap-to-call, maps open in one click, and the contact form is easy to fill in and adapted to your visitors.'],
],

'area_served' => ['Pančevo', 'Starčevo', 'Omoljica', 'Jabuka', 'Kačarevo', 'Dolovo', 'Opovo', 'Kovačica', 'Kovin', 'Alibunar', 'Vršac', 'South Banat District', 'Belgrade', 'Serbia'],
],
],

/* ═══ BEOGRAD ═══ */
'beograd' => [
'sr' => [

'serv_h2'   => 'Šta sve radimo za klijente u Beogradu <em>-</em>',
'serv_lead' => 'Na beogradskom tržištu pobeđuje ono što je urađeno do kraja. Strategiju, dizajn, izradu i optimizaciju vodimo interno, uz jasno definisane uloge i jednu osobu zaduženu za Vaš projekat od početka do kraja.',
'serv' => [
    ['code-slash',   'Sajtovi i web aplikacije',    'Izrađujemo prezentacione sajtove, online kataloge i web aplikacije prilagođene konkretnim potrebama Vašeg poslovanja. Svako rešenje razvijamo individualno, sa fokusom na brzinu, funkcionalnost i prepoznatljiv vizuelni identitet.'],
    ['cart',         'Online prodavnice',           'Web shop spreman za ozbiljan promet: filteri, varijante proizvoda, integracija sa kurirskim službama i sistemom za fakturisanje, plus analitika prodaje.'],
    ['arrow-repeat', 'Redizajn postojećeg sajta',   'Za firme koje već imaju saobraćaj, ali gube kupce na zastarelom dizajnu i sporom učitavanju. Pozicije u pretrazi se čuvaju, utisak i konverzija rastu.'],
    ['search',       'SEO optimizacija',            'Optimizujemo sajt tako da bude vidljiviji u lokalnim Google pretragama i povezan sa Vašim poslovnim profilom, kako bi Vas korisnici lakše pronašli kada traže upravo ono što nudite.'],
    ['tools',        'Održavanje i podrška',        'Redovno održavanje, bezbednosne provere, rezervne kopije i pravovremene izmene kako bi Vaš sajt uvek bio stabilan, ažuran i spreman da podrži svakodnevno poslovanje.'],
    ['palette2',     'Brending i grafički dizajn',  'Vizuelni identitet koji Vašem brendu daje dosledan i profesionalan izgled - od logotipa, boja i tipografije do prezentacija i materijala za kampanje.'],
],

'proc_h2'   => 'Kako izgleda saradnja od poziva do lansiranja <em>-</em>',
'proc_lead' => 'Proces je podeljen u četiri jasna koraka, sa definisanim rokovima i jednom kontakt osobom tokom cele saradnje. Uvodni sastanak možemo održati uživo ili online, ali kada je moguće biramo susret uživo jer nam daje bolji uvid u Vaše poslovanje i ciljeve.',
'proc' => [
    ['Razgovor i analiza',   'Definišemo cilj: više upita, veća prodaja ili ozbiljniji utisak pred klijentima. Istražujemo Vašu publiku i konkurenciju na beogradskom tržištu i pronalazimo prostor u kojem se možete izdvojiti.'],
    ['Plan i struktura',     'Slažemo mapu stranica, dizajn, poruke i put posetioca do konverzije. Dizajn radimo za Vaš brend, ne po šablonu, a Vi dobijate pisanu ponudu sa fiksnom cenom, rokovima po fazama i spiskom svega što ulazi u posao.'],
    ['Izrada i testiranje',  'Sajt razvijamo, unosimo sadržaj i detaljno testiramo na različitim uređajima i najčešće korišćenim pretraživačima. Posebnu pažnju posvećujemo brzini učitavanja i optimizaciji performansi.'],
    ['Lansiranje i podrška', 'Sajt objavljujemo na Vašem domenu, povezujemo potrebne Google alate i pripremamo sve za praćenje rezultata. Pokazujemo Vam kako da samostalno upravljate sadržajem, a i nakon objave ostajemo dostupni za podršku i izmene.'],
],

'ind_h2'   => 'Za koga pravimo sajtove u Beogradu <em>-</em>',
'ind_lead' => 'Ne vezujemo se za jednu branšu. Način rada prilagođavamo svakom poslu kojem je stalo do vidljivosti i ozbiljnog nastupa pred kupcima. Ovo su delatnosti sa kojima najčešće radimo u Beogradu i okolini.',
'ind' => [
    'IT firme i startapi',
    'Advokatske i konsultantske kancelarije',
    'Klinike, ordinacije i estetski centri',
    'Agencije za nekretnine',
    'Online prodavnice i distributeri',
    'Restorani, barovi i ugostiteljstvo',
    'Finansije, osiguranje i knjigovodstvo',
    'Privatne škole i edukativni centri',
    'Arhitektura, enterijer i građevina',
    'Agencije za organizaciju događaja i marketing',
    'Fitnes, wellness i sport',
    'Veleprodaja, proizvodnja i logistika',
],

'price_h2'   => 'Koliko košta izrada web sajta u Beogradu <em>-</em>',
'price_lead' => 'Svaki sajt ima drugačije zahteve, zato se i cena formira prema onome što projekat zaista podrazumeva. Izdvojili smo pet ključnih faktora koji najviše utiču na konačnu ponudu.',
'price' => [
    ['Obim sajta',              'Broj stranica, jezičkih verzija i tipova sadržaja. Korporativni sajt sa katalogom, karijerama i blogom nije isti posao kao jednostrana prezentacija.'],
    ['Dizajn po meri',          'Na cenu utiče koliko je dizajn složen i koliko se elemenata crta isključivo za Vaš brend. Detaljniji i prepoznatljiviji dizajn znači više sati - i na izradi i na implementaciji.'],
    ['Funkcionalnosti',         'Prodavnica, rezervacije, korisnički portal, integracije sa ERP-om, CRM-om ili kurirskim službama - svaka integracija je zaseban deo posla i posebno se procenjuje.'],
    ['Sadržaj i strategija',    'Tekstovi pisani da prodaju, fotografije, prevod i priprema SEO strukture. Na konkurentnom tržištu ovo je često razlika između sajta koji radi i sajta koji samo postoji.'],
    ['Šta ide posle lansiranja','Troškovi hostinga, domena i budžeta za oglašavanje nisu deo naše naknade i plaćaju se direktno izabranim provajderima. Sve okvirne troškove dobijate unapred, zajedno sa ponudom.'],
],
'price_note' => 'Nakon uvodnog razgovora - uživo u Beogradu ili preko video poziva - dobijate pisanu ponudu sa fiksnom cenom, rokovima po fazama i tačnim spiskom onoga što ulazi u posao. Ponuda stiže u roku od 24 sata, besplatna je, napisana tako da možete da je uporedite sa bilo kojom drugom, i ne stvara nikakve obaveze prema nama.',

'faq_h2'   => 'Česta pitanja o izradi sajta u Beogradu <em>-</em>',
'faq_lead' => 'Pitanja koja najčešće čujemo od beogradskih klijenata pre potpisivanja. Ako Vaše nije ovde, javite se - odgovaramo istog dana.',
'faq' => [
    ['check2-circle',     'Zašto izabrati VUG Digital Agency za izradu web sajta u Beogradu?',
                       'U VUG Digital Agency svaki web sajt razvijamo namenski, bez gotovih šablona, uz fokus na brzinu, funkcionalnost i SEO optimizaciju. Naša rešenja omogućavaju jednostavnu nadogradnju novim funkcionalnostima kako Vaš biznis raste. Uz direktnu komunikaciju, transparentne uslove i individualan pristup, dobijate web sajt prilagođen Vašim poslovnim ciljevima.'],
    ['briefcase',      'Koliko košta izrada web sajta u Beogradu?',
                       'Cena zavisi od obima, složenosti funkcionalnosti i toga da li je dizajn po meri. Zato ne objavljujemo cenovnik „od“ - on na beogradskom tržištu ionako ne znači ništa dok se ne zna šta sajt treba da radi. Posle kratkog razgovora dobijate <strong>pisanu ponudu sa fiksnom cenom, rokovima po fazama i spiskom svega što ulazi u posao</strong>, u roku od 24 sata.'],
    ['clock',          'Koliko traje izrada sajta?',
                       'Prezentacioni sajt srednjeg obima najčešće je gotov za <strong>8 do 12 dana</strong>, a korporativni sajtovi, online prodavnice i web aplikacije mogu i duže, zavisno od obima i integracija. Rok delimo na faze sa tačnim datumima, pa u svakom trenutku znate dokle se stiglo i šta se čeka od Vas.'],
    ['star-fill',      'Po čemu se Vaš sajt razlikuje od jeftinih šablonskih rešenja?',
                       'Šablon je isti kod Vas i kod još nekoliko hiljada firmi koje su ga kupile, nosi kod koji Vam ne treba i zato se sporo učitava. Mi pišemo <strong>dizajn i kod po meri Vašeg posla</strong>: sajt je lakši, brži, prilagođen tome kako Vaši kupci zaista donose odluku i, što je najvažnije na beogradskom tržištu, ne liči ni na jedan drugi.'],
    ['code-slash',     'Da li radite i web aplikacije, ne samo prezentacione sajtove?',
                       'Radimo. Pravimo korisničke portale, interne alate, sisteme za rezervacije, kalkulatore ponuda i platforme povezane sa Vašim postojećim programima. <strong>Ako proces već postoji u firmi, prilagođavamo aplikaciju njemu</strong>, umesto da Vas teramo da menjate način rada zbog softvera.'],
    ['graph-up',       'Kako ću se izdvojiti od konkurencije koja već ima sajt?',
                       'Pre dizajna analiziramo najjaču konkurenciju iz Vaše branše: šta nude, kako to predstavljaju i gde su im praznine. Sajt onda gradimo oko <strong>onoga što Vi radite bolje</strong> i oko pitanja na koja konkurencija ne odgovara. Izdvajanje nije stvar ukrasa nego jasnije poruke, bržeg sajta i lakšeg puta do kontakta.'],
    ['search',         'Da li se sajt priprema za Google?',
                       'Svaki sajt isporučujemo tehnički spreman za pretragu: brzo učitavanje i dobri Core Web Vitals pokazatelji, ispravna struktura naslova, opisi stranica, mapa sajta, strukturirani podaci i povezan Search Console. <strong>Ozbiljne pozicije na konkurentnim pojmovima traže vreme i stalan rad</strong> - to je posebna, mesečna usluga o kojoj razgovaramo otvoreno, sa realnim rokovima i bez obećanja prvog mesta za nedelju dana.'],
    ['person',         'Ko je vlasnik domena, hostinga i koda?',
                       'Vi. Domen i hosting idu <strong>na Vaše ime i Vašu firmu</strong>, pristupne podatke dobijate po lansiranju, a sajt je Vaše vlasništvo. U svakom trenutku možete da ga prenesete drugom izvođaču - ne koristimo zatvorena rešenja koja Vas vezuju za nas.'],
    ['phone',          'Da li sajt radi na mobilnom telefonu?',
                       'Radi, i tako ga gradimo od prve skice. Većina poseta danas stiže sa telefona, pa <strong>svaki ekran prvo složimo za mobilni</strong>, a tek onda za tablet i računar. Broj telefona se poziva jednim dodirom, mapa se otvara u jednom kliku, a kontakt forma je kratka i jednostavna za popunjavanje.'],
],

'area_served' => ['Beograd', 'Novi Beograd', 'Zemun', 'Vračar', 'Stari grad', 'Savski venac', 'Zvezdara', 'Voždovac', 'Palilula', 'Čukarica', 'Rakovica', 'Surčin', 'Obrenovac', 'Grocka', 'Srbija'],
],

'en' => [

'serv_h2'   => 'What we do for clients in Belgrade <em>-</em>',
'serv_lead' => 'In the Belgrade market, what wins is work that is finished properly. We run strategy, design, build and optimisation in-house, with clearly defined roles and one person responsible for your project from start to finish.',
'serv' => [
    ['code-slash',   'Websites and web applications', 'We build brochure sites, online catalogues and web applications shaped around the specific needs of your business. Every solution is developed individually, with a focus on speed, functionality and a distinctive visual identity.'],
    ['cart',         'Online shops',                 'A web shop ready for serious volume: filters, product variants, integration with courier services and your invoicing system, plus sales analytics.'],
    ['arrow-repeat', 'Redesign of an existing site',  'For companies that already have traffic but lose customers to a dated design and slow loading. Search positions are preserved - the impression and the conversion rate go up.'],
    ['search',       'SEO optimisation',              'We optimise the site to be more visible in local Google searches and connected to your business profile, so people find you more easily when they search for exactly what you offer.'],
    ['tools',        'Maintenance and support',       'Regular maintenance, security checks, backups and timely changes, so your site is always stable, up to date and ready to support your day-to-day business.'],
    ['palette2',     'Branding and graphic design',   'A visual identity that gives your brand a consistent, professional look - from the logo, colours and typography through to presentations and campaign materials.'],
],

'proc_h2'   => 'What the project looks like, from call to launch <em>-</em>',
'proc_lead' => 'The process is split into four clear steps, with defined deadlines and a single point of contact throughout. The introductory meeting can be held in person or online, but where possible we choose to meet in person, as it gives us a better insight into your business and your goals.',
'proc' => [
    ['Conversation and analysis', 'We define the goal: more enquiries, more sales or a more serious impression in front of clients. We research your audience and the competition in the Belgrade market and find the space where you can stand out.'],
    ['Plan and structure',        'We build the page map, the design, the messaging and the visitor’s path to conversion. We design for your brand, not from a template, and you receive a written quote with a fixed price, deadlines per phase and a list of everything the job includes.'],
    ['Build and testing',         'We develop the site, enter the content and test it thoroughly across different devices and the most widely used browsers. We pay particular attention to loading speed and performance optimisation.'],
    ['Launch and support',        'We publish the site on your domain, connect the Google tools you need and set everything up for tracking results. We show you how to manage the content yourself, and we stay available for support and changes after launch.'],
],

'ind_h2'   => 'Who we build websites for in Belgrade <em>-</em>',
'ind_lead' => 'We are not tied to one branch of business. We shape the way we work around any company that cares about being visible and taken seriously by its customers. These are the industries we work with most often in Belgrade and the surrounding area.',
'ind' => [
    'IT companies and startups',
    'Law and consulting firms',
    'Clinics, practices and aesthetic centres',
    'Real estate agencies',
    'Online shops and distributors',
    'Restaurants, bars and hospitality',
    'Finance, insurance and accounting',
    'Private schools and training centres',
    'Architecture, interiors and construction',
    'Event and marketing agencies',
    'Fitness, wellness and sport',
    'Wholesale, manufacturing and logistics',
],

'price_h2'   => 'How much does a website in Belgrade cost <em>-</em>',
'price_lead' => 'Every website comes with different requirements, which is why the price is set according to what the project actually involves. We have singled out the five key factors that influence the final quote the most.',
'price' => [
    ['Scope of the site',   'The number of pages, language versions and content types. A corporate site with a catalogue, a careers section and a blog is not the same job as a one-page presentation.'],
    ['Custom design',       'What drives the price is how complex the design is and how many elements are drawn exclusively for your brand. A more detailed, more distinctive design means more hours - both in design and in implementation.'],
    ['Functionality',       'A store, booking, a customer portal, integrations with an ERP, a CRM or courier services - every integration is a separate part of the job and is quoted separately.'],
    ['Content and strategy','Copy written to sell, photography, translation and the SEO structure. In a competitive market this is often the difference between a site that works and a site that merely exists.'],
    ['What comes after launch', 'The cost of hosting, the domain and the advertising budget is not part of our fee and is paid directly to the providers you choose. You receive all the approximate costs in advance, together with the quote.'],
],
'price_note' => 'After an introductory conversation - in person in Belgrade or over a video call - you receive a written quote with a fixed price, deadlines per phase and an exact list of what the job includes. The quote arrives within 24 hours, is free of charge, written so you can compare it with any other, and creates no obligation towards us.',

'faq_h2'   => 'Frequently asked questions about websites in Belgrade <em>-</em>',
'faq_lead' => 'The questions we hear most often from Belgrade clients before signing. If yours isn’t here, get in touch - we reply the same day.',
'faq' => [
    ['star-fill',      'Why choose VUG Digital Agency for website development in Belgrade?',
                       'At VUG Digital Agency we build every website for its purpose, with no ready-made templates, focusing on speed, functionality and SEO optimisation. Our solutions make it easy to add new functionality as your business grows. With direct communication, transparent terms and an individual approach, you get a website tailored to your business goals.'],
    ['briefcase',      'How much does a website in Belgrade cost?',
                       'The price depends on the scope, the complexity of the functionality and whether the design is custom. That is why we don’t publish a “starting from” price list - in the Belgrade market it means nothing until it is clear what the site has to do. After a short conversation you receive a <strong>written quote with a fixed price, deadlines per phase and a list of everything the job includes</strong>, within 24 hours.'],
    ['clock',          'How long does it take to build a website?',
                       'A mid-sized brochure site is usually finished in <strong>8 to 12 days</strong>, while corporate sites, online stores and web applications can take longer, depending on the scope and the integrations. We split the timeline into phases with exact dates, so at any moment you know where things stand and what is waiting on you.'],
    ['star-fill',      'How is your website different from cheap template solutions?',
                       'A template is identical for you and for the several thousand other companies that bought it, it carries code you don’t need and that is why it loads slowly. We write <strong>the design and the code to fit your business</strong>: the site is lighter, faster, built around how your customers actually decide and - most important in the Belgrade market - it looks like nothing else out there.'],
    ['code-slash',     'Do you build web applications too, not just brochure sites?',
                       'We do. We build customer portals, internal tools, booking systems, quote calculators and platforms connected to your existing software. <strong>If the process already exists in your company, we adapt the application to it</strong>, instead of forcing you to change how you work because of the software.'],
    ['graph-up',       'How will I stand out from competitors who already have a website?',
                       'Before any design work we analyse the strongest competitors in your industry: what they offer, how they present it and where the gaps are. We then build the site around <strong>what you do better</strong> and around the questions your competitors leave unanswered. Standing out isn’t a matter of decoration but of a clearer message, a faster site and an easier path to contact.'],
    ['search',         'Is the site prepared for Google?',
                       'Every site we deliver is technically ready for search: fast loading and good Core Web Vitals, a correct heading structure, page descriptions, a sitemap, structured data and a connected Search Console. <strong>Serious rankings on competitive terms take time and steady work</strong> - it is a separate monthly service we discuss openly, with realistic timeframes and no promises of first place within a week.'],
    ['person',         'Who owns the domain, the hosting and the code?',
                       'You do. The domain and hosting go <strong>in your name and your company’s name</strong>, you receive the access details at launch, and the site is your property. You can hand it over to another contractor at any time - we don’t use closed solutions that tie you to us.'],
    ['phone',          'Does the site work on mobile phones?',
                       'It does, and we build it that way from the first sketch. Most visits now come from a phone, so <strong>we lay out every screen for mobile first</strong>, and only then for tablet and desktop. The phone number dials with a single tap, the map opens in one click, and the contact form is short and simple to fill in.'],
],

'area_served' => ['Belgrade', 'New Belgrade', 'Zemun', 'Vračar', 'Stari grad', 'Savski venac', 'Zvezdara', 'Voždovac', 'Palilula', 'Čukarica', 'Rakovica', 'Surčin', 'Obrenovac', 'Grocka', 'Serbia'],
],
],

], /* end web */

/* ────────────────────────────────────────────────────────────────────────────
   VOĐENJE DRUŠTVENIH MREŽA - zasad FAQ + lokalni blok.
   (Dodavanjem 'serv'/'proc'/'ind'/'price' ključeva sekcije se pojave same.)
   ──────────────────────────────────────────────────────────────────────────── */
'social' => [

/* ═══ PANČEVO ═══ */
'pancevo' => [
'sr' => [

'serv_h2'   => 'Šta sve radimo na Vašim mrežama u Pančevu <em>-</em>',
'serv_lead' => 'Profil preuzimamo u celosti - od plana i snimanja do objava, poruka i izveštaja. Vi odobravate, mi radimo ostalo, a sadržaj izlazi po dogovorenom ritmu bez pauza.',
'serv' => [
    ['calendar-check', 'Plan sadržaja i objavljivanje', 'Mesečni plan tema i objava koji dobijate unapred na odobrenje. Znate šta izlazi, kog dana i zašto - bez improvizacije u poslednji čas.'],
    ['palette2',       'Dizajn vizuala',               'Grafike, priče i korice u bojama Vašeg brenda. Profil posle par nedelja izgleda kao celina, a ne kao skup nepovezanih objava.'],
    ['play-fill',      'Snimanje i montaža',           'Dolazimo kod Vas i snimamo u radnji, salonu ili na terenu. Montažu, tekst i muziku radimo mi.'],
    ['chat-dots',      'Komunikacija sa pratiocima',         'Odgovaramo na komentare i poruke u radno vreme, tonom koji smo prethodno usaglasili. Sve što traži Vašu odluku prosleđujemo odmah.'],
    ['cash-coin',      'Oglašavanje (Meta Ads)',       'Ciljane kampanje prema ljudima iz Pančeva i okoline - za posete radnji, poruke ili pozive, a ne za prazne lajkove.'],
    ['graph-up',       'Izveštaji i analitika',        'Svakog meseca dobijate brojeve koji nešto znače: doseg, nove pratioce, poruke i klikove, uz zaključak šta je dobro, a šta moramo da popravimo za sledeći mesec.'],
],

'proc_h2'   => 'Kako izgleda saradnja od prvog poziva <em>-</em>',
'proc_lead' => 'Četiri koraka, jasan mesečni ritam i jedna osoba sa kojom komunicirate. Prvi sastanak najčešće držimo uživo jer tako najbrže uhvatimo ton kojim Vaš brend govori.',
'proc' => [
    ['Analiza profila i publike',  'Pregledamo postojeće naloge, vidimo šta je do sada radilo, ko Vas prati i ko su Vam kupci. Istražimo i konkurenciju i njihov nastup na mrežama.'],
    ['Strategija i plan sadržaja',  'Biramo mreže na kojima Vaša publika zaista jeste, definišemo rubrike, ton i ritam objavljivanja. Dobijate pisani plan za prvi mesec i ponudu sa jasnim obimom.'],
    ['Produkcija i objavljivanje', 'Snimamo i dizajniramo sadržaj, pišemo tekstove i objavljujemo po kalendaru. Sve objave vidite pre izlaska i imate pravo na izmene.'],
    ['Oglašavanje i izveštaj',     'Pokrećemo kampanje prema dogovorenom budžetu, pratimo šta donosi upite, a na kraju meseca šaljemo izveštaj sa preporukom za sledeći korak.'],
],

'ind_h2'   => 'Za koga vodimo mreže u Pančevu <em>-</em>',
'ind_lead' => 'Radimo sa lokalnim poslovima kojima kupac dolazi iz okoline - onima koje ljudi prvo vide na Instagramu, pa tek onda uživo. Ovo su poslovi čije profile najčešće vodimo u Pančevu i okolini.',
'ind' => [
    'Restorani, picerije i brza hrana',
    'Saloni lepote, frizeri i barberi',
    'Teretane i fitnes studiji',
    'Stomatološke ordinacije',
    'Prodavnice i butici',
    'Poslastičarnice i pekare',
    'Auto-placevi, servisi i perionice',
    'Sale za proslave i event centri',
    'Škole stranih jezika i igraonice',
    'Agencije za nekretnine',
    'Zanatske radnje i majstori',
    'Wellness, spa i masaža',
],

'price_h2'   => 'Koliko košta vođenje društvenih mreža u Pančevu <em>-</em>',
'price_lead' => 'Radimo na mesečnom nivou, po obimu koji se dogovori unapred. Ovo je pet stvari koje utiču na cenu paketa.',
'price' => [
    ['Broj mreža',            'Jedan Instagram i kombinacija Instagram + Facebook + TikTok nisu isti posao. Sadržaj se prilagođava svakoj mreži, ne kopira se u istom obliku.'],
    ['Obim sadržaja',         'Koliko objava, priča i reels-a izlazi mesečno. Više sadržaja znači više sati na pisanju, dizajnu i montaži.'],
    ['Produkcija na terenu',  'Ako dolazimo kod Vas da snimamo, to je poseban deo posla. Ako nam Vi šaljete materijal, onda korigujemo cenu paketa.'],
    ['Komunikacija sa pratiocima',  'Odgovaranje na poruke i komentare umesto Vas. Zavisi od toga koliko upita profil dobija i u kom roku treba odgovoriti.'],
    ['Oglašavanje',           'Vođenje kampanja je naš rad. Budžet koji ide Meti plaćate direktno, sa svog naloga, pa u svakom trenutku vidite koliko je potrošeno.'],
],
'price_note' => 'Ne radimo „paket“ u koji se ne vidi šta ulazi. Posle kratkog razgovora dobijate pisanu ponudu sa tačnim brojem objava, priča i reels-a, jasnom mesečnom cenom i spiskom onoga što se plaća odvojeno. Ponudu šaljemo u roku od 24 sata, bez naknade i bez obaveze da nastavite dalje.',

'rev' => true,   // sekcija „Šta kažu klijenti“ (partials/testimonials.php)

'faq_h2'   => 'Česta pitanja o vođenju društvenih mreža u Pančevu <em>-</em>',
'faq_lead' => 'Pitanja koja nam klijenti iz Pančeva najčešće postavljaju pre početka saradnje.',
'faq' => [
    ['briefcase', 'Koliko košta vođenje društvenih mreža u Pančevu?',
                  'Cena zavisi od broja mreža, broja objava mesečno i toga da li snimamo sadržaj na terenu. Radimo <strong>mesečno, po jasno definisanom obimu</strong>: tačno se zna koliko objava, priča i reels-a ulazi u dogovor. Ponudu dobijate u roku od 24 sata, bez obaveze.'],
    ['calendar-check', 'Koliko objava mesečno je dovoljno?',
                  'Za lokalni biznis u Pančevu najčešće je dovoljno <strong>osam do dvanaest objava mesečno, uz redovne priče</strong> tokom nedelje. Bitnija je doslednost nego količina - profil koji objavljuje svake nedelje po planu nadmašuje onaj sa deset objava u jednom danu, pa tišinom mesec dana.'],
    ['play-fill', 'Da li Vi snimate sadržaj ili to moram ja?',
                  'Možemo oboje. Pošto smo iz Pančeva, <strong>dolazimo kod Vas i snimamo na licu mesta</strong> - u radnji, salonu ili na gradilištu. Ako Vam je lakše, snimate telefonom po našem kratkom uputstvu, a mi radimo montažu, tekst i objavu.'],
    ['chat-dots', 'Ko odgovara na poruke i komentare?',
                  'Mi, ako tako dogovorimo. Odgovaranje na komentare i poruke je deo usluge: <strong>odgovaramo na komentare i poruke u radno vreme</strong>, po tonu i informacijama koje smo prethodno usaglasili sa Vama. Sve što traži Vašu odluku prosleđujemo odmah.'],
    ['check2-circle', 'Da li mogu da vidim sadržaj pre objave?',
                  'Naravno. <strong>Mesečni plan sa temama i vizualima dobijate na odobrenje pre početka meseca</strong>, pa ništa ne izlazi bez Vaše saglasnosti. Izmene u toj fazi su uobičajene i ne naplaćuju se posebno.'],
    ['cash-coin', 'Da li je oglašavanje uračunato u cenu?',
                  'Rad na kampanjama jeste, ali <strong>budžet koji ide Meti plaćate direktno Vi</strong> - tako uvek vidite koliko je potrošeno i na šta. Preporučujemo iznos primeren lokalnom tržištu i pokazujemo šta je za taj novac postignuto.'],
    ['clock',     'Da li moram da potpišem dugoročan ugovor?',
                  'Ne. Saradnja ide iz meseca u mesec i možete je prekinuti kad god želite, uz najavu do kraja tekućeg meseca. <strong>Nalozi, objavljeni materijali i pristupni podaci ostaju Vaši</strong> - ne držimo klijente ugovorom nego rezultatom.'],
    ['graph-up',  'Kako znam da li se isplati?',
                  'Svakog meseca dobijate izveštaj sa brojevima koji nešto znače: <strong>doseg, novi pratioci, poruke, klikovi ka sajtu i pozivi</strong>, uz kratak zaključak šta je radilo, a šta menjamo sledeći mesec. Bez „lajkova“ kao jedinog pokazatelja. Ako još nemate sajt na koji bi ti klikovi vodili, pogledajte kako radimo <a href="{lp_web_pancevo}">izradu web sajta u Pančevu</a>.'],
],
'area_served' => ['Pančevo', 'Starčevo', 'Omoljica', 'Jabuka', 'Kačarevo', 'Dolovo', 'Opovo', 'Kovačica', 'Kovin', 'Alibunar', 'Vršac', 'Južnobanatski okrug', 'Beograd', 'Srbija'],
],

'en' => [

'serv_h2'   => 'What we do on your channels in Pančevo <em>-</em>',
'serv_lead' => 'We take the profile over completely - from planning and filming to posting, replies and reporting. You approve, we do the rest, and content goes out on the agreed rhythm, without gaps.',
'serv' => [
    ['calendar-check', 'Content plan & posting',   'A monthly plan of topics and posts, sent to you for approval in advance. You know what goes out, on which day and why - no last-minute improvising.'],
    ['palette2',       'Visual design',            'Graphics, stories and covers in your brand colours. After a couple of weeks the profile looks like one piece, not a pile of unrelated posts.'],
    ['play-fill',      'Filming and editing',      'We come to you and film in your shop, salon or on site. Editing, captions and music are on us.'],
    ['chat-dots',      'Community management',     'We answer comments and messages during working hours, in the tone we agreed beforehand. Anything needing your decision is forwarded immediately.'],
    ['cash-coin',      'Advertising (Meta Ads)',   'Targeted campaigns aimed at people in Pančevo and the surrounding area - for shop visits, messages or calls, not for empty likes.'],
    ['graph-up',       'Reports and analytics',    'Every month you get numbers that mean something: reach, new followers, messages and clicks, plus a conclusion on what is working and what we need to fix for next month.'],
],

'proc_h2'   => 'What the collaboration looks like, from the first call <em>-</em>',
'proc_lead' => 'Four steps, a clear monthly rhythm and one person you talk to. We usually hold the first meeting in person, because that is the fastest way to catch the tone your brand speaks in.',
'proc' => [
    ['Profile and audience analysis', 'We review the existing accounts, see what has worked so far, who follows you and who your customers are. We also research the competition and how they perform on social.'],
    ['Strategy and content plan',     'We pick the channels your audience is actually on, define the content pillars, the tone and the posting rhythm. You get a written plan for the first month and a quote with a clear scope.'],
    ['Production and posting',        'We film and design the content, write the captions and post to the calendar. You see every post before it goes live and can ask for changes.'],
    ['Advertising and reporting',     'We launch campaigns within the agreed budget, track what brings enquiries, and at the end of the month send a report with a recommendation for the next step.'],
],

'ind_h2'   => 'Whose channels we run in Pančevo <em>-</em>',
'ind_lead' => 'We work with local businesses whose customers come from the surrounding area - the ones people see on Instagram first and in person second. These are the businesses whose channels we run most often in Pančevo and the surrounding area.',
'ind' => [
    'Restaurants, pizzerias and fast food',
    'Beauty salons, hairdressers and barbers',
    'Gyms and fitness studios',
    'Dental practices',
    'Shops and boutiques',
    'Patisseries and bakeries',
    'Car dealerships, services and car washes',
    'Function rooms and event venues',
    'Language schools and play centres',
    'Real estate agencies',
    'Trades and craftspeople',
    'Wellness, spa and massage',
],

'price_h2'   => 'How much does social media management in Pančevo cost <em>-</em>',
'price_lead' => 'We work on a monthly basis, to a scope agreed in advance. These are the five things that affect the price of the package.',
'price' => [
    ['Number of channels',   'One Instagram account and a combination of Instagram + Facebook + TikTok are not the same job. Content is adapted to each channel rather than copied across in the same form.'],
    ['Volume of content',    'How many posts, stories and reels go out each month. More content means more hours of writing, design and editing.'],
    ['On-location filming',  'If we come to you to shoot, that is a separate part of the job. If you send us the material, we adjust the price of the package.'],
    ['Community management', 'Replying to messages and comments on your behalf. It depends on how many enquiries the profile gets and how quickly they need an answer.'],
    ['Advertising',          'Running the campaigns is our work. The budget that goes to Meta you pay directly, from your own account, so you always see how much was spent.'],
],
'price_note' => 'We don’t sell a “package” you cannot see into. After a short conversation you receive a written quote with the exact number of posts, stories and reels, a clear monthly price and a list of what is paid separately. We send the quote within 24 hours, free of charge and with no obligation to go further.',

'rev' => true,

'faq_h2'   => 'Frequently asked questions about social media management in Pančevo <em>-</em>',
'faq_lead' => 'The questions clients from Pančevo ask us most often before we start.',
'faq' => [
    ['briefcase', 'How much does social media management in Pančevo cost?',
                  'The price depends on the number of channels, the number of posts per month and whether we shoot content on location. We work <strong>monthly, with a clearly defined scope</strong>: you know exactly how many posts, stories and reels are included. You receive the quote within 24 hours, with no obligation.'],
    ['calendar-check', 'How many posts a month are enough?',
                  'For a local business in Pančevo, <strong>eight to twelve posts a month, plus regular stories</strong> throughout the week is usually enough. Consistency matters more than volume - a profile that posts every week to a plan beats one with ten posts in a single day followed by a month of silence.'],
    ['play-fill', 'Do you shoot the content, or do I have to?',
                  'Either works. Since we are based in Pančevo, <strong>we come to you and shoot on location</strong> - in your shop, salon or on site. If it’s easier, you film on your phone following our short brief, and we handle the editing, the caption and the posting.'],
    ['chat-dots', 'Who replies to messages and comments?',
                  'We do, if that’s what we agree. Community management is part of the service: <strong>we answer comments and messages during working hours</strong>, in the tone and with the information we agreed with you beforehand. Anything that needs your decision is forwarded immediately.'],
    ['check2-circle', 'Can I see the content before it is published?',
                  'Of course. <strong>The monthly plan with topics and visuals comes to you for approval before the month starts</strong>, so nothing goes out without your agreement. Changes at that stage are normal and are not charged separately.'],
    ['cash-coin', 'Is advertising included in the price?',
                  'The campaign work is, but <strong>the budget that goes to Meta you pay directly</strong> - so you always see how much was spent and on what. We recommend an amount that fits the local market and show what it achieved.'],
    ['clock',     'Do I have to sign a long-term contract?',
                  'No. The collaboration runs month to month and you can end it whenever you like, with notice by the end of the current month. <strong>The accounts, the published material and the access details stay yours</strong> - we keep clients through results, not contracts.'],
    ['graph-up',  'How do I know it’s worth it?',
                  'Every month you receive a report with numbers that mean something: <strong>reach, new followers, messages, clicks to your website and calls</strong>, plus a short conclusion on what worked and what we change next month. No “likes” as the only metric. If you don’t yet have a website for those clicks to land on, see how we approach <a href="{lp_web_pancevo}">website development in Pančevo</a>.'],
],
'area_served' => ['Pančevo', 'Starčevo', 'Omoljica', 'Jabuka', 'Kačarevo', 'Dolovo', 'Opovo', 'Kovačica', 'Kovin', 'Alibunar', 'Vršac', 'South Banat District', 'Belgrade', 'Serbia'],
],
],

/* ═══ BEOGRAD ═══ */
'beograd' => [
'sr' => [

'serv_h2'   => 'Šta sve radimo na Vašim mrežama u Beogradu <em>-</em>',
'serv_lead' => 'Profil vodimo od strategije do izveštaja, sa jednom osobom zaduženom za Vaš brend. Plan odobravate Vi, sve ostalo je na nama, a objave izlaze po utvrđenom kalendaru bez prekida.',
'serv' => [
    ['calendar-check', 'Kalendar objava', 'Mesečni kalendar sa temama, formatima i datumima, na odobrenje pre početka meseca. Ritam se drži i kada je sezona najgušća.'],
    ['palette2',       'Dizajn vizuala',               'Vizuelni sistem koji se prepozna u feedu i pre nego što se pročita ime brenda - grafike, korice, priče i šabloni za dalju upotrebu.'],
    ['play-fill',      'Produkcija reels-a',           'Snimanje i montaža kratke forme, na Vašoj lokaciji ili u dogovorenom terminu. Montaža, titlovi i izbor muzike su na nama.'],
    ['chat-dots',      'Odgovaranje na poruke i komentare',         'Poruke, komentari i upiti dobijaju odgovor u radnom vremenu, po unapred usaglašenim odgovorima na česta pitanja. Ono o čemu Vi treba da odlučite prosleđujemo bez čekanja.'],
    ['cash-coin',      'Meta i TikTok kampanje',       'Postavka publika, testiranje kreativa i optimizacija prema cilju - poruke, prodaja ili poseta lokalu, zavisno od toga šta Vam treba.'],
    ['graph-up',       'Mesečni izveštaji',            'Doseg, rast, interakcije i klikovi u poređenju sa prethodnim mesecom, uz kratak zaključak šta je dalo rezultat, a šta popravljamo u narednom mesecu.'],
],

'proc_h2'   => 'Kako izgleda saradnja od prvog poziva <em>-</em>',
'proc_lead' => 'Proces ima četiri koraka, mesečni ritam i jednu kontakt osobu. Uvodni sastanak držimo uživo u Beogradu kad god je moguće - to je najbrži način da razumemo brend i publiku kojoj se obraća.',
'proc' => [
    ['Analiza profila i publike',  'Prolazimo kroz naloge, statistiku i dosadašnji sadržaj. Mapiramo publiku i pregledamo kako nastupaju najjači konkurenti iz Vaše branše.'],
    ['Strategija i kalendar objava',  'Postavljamo cilj, biramo dve do tri mreže koje se stvarno isplate i definišemo rubrike i ton. Dobijate plan za prvi mesec i ponudu sa preciznim obimom.'],
    ['Produkcija i objavljivanje', 'Snimamo, dizajniramo i pišemo, pa objavljujemo po kalendaru. Sadržaj ide na Vaše odobrenje pre izlaska, sa prostorom za izmene.'],
    ['Oglašavanje i izveštaj',     'Kampanje se postavljaju i optimizuju tokom meseca, a na kraju dobijate izveštaj sa rezultatima i planom za naredni period.'],
],

'ind_h2'   => 'Za koga vodimo mreže u Beogradu <em>-</em>',
'ind_lead' => 'Sarađujemo sa brendovima kojima je feed prva prodajna tačka - tamo gde odluka padne pre nego što neko uopšte pozove. Ovo su brendovi čije profile najčešće vodimo u Beogradu i okolini.',
'ind' => [
    'Restorani, barovi i klubovi',
    'Estetski i wellness centri',
    'Fitnes studiji i teretane',
    'Modni brendovi i online prodavnice',
    'Klinike i specijalističke ordinacije',
    'Agencije za nekretnine',
    'Hoteli i smeštajni kapaciteti',
    'Agencije za organizaciju proslava i venčanja',
    'Online kursevi i edukativni brendovi',
    'Kafići i kafeterije',
    'Auto industrija i saloni',
    'IT i B2B brendovi',
],

'price_h2'   => 'Koliko košta vođenje društvenih mreža u Beogradu <em>-</em>',
'price_lead' => 'Naknada je mesečna i formira se prema obimu koji dogovorimo na početku. Ovih pet stavki određuje cenu paketa.',
'price' => [
    ['Broj mreža',            'Instagram sam za sebe, ili u kombinaciji sa Facebook-om, TikTok-om i LinkedIn-om. Za svaku mrežu sadržaj se posebno prilagođava.'],
    ['Obim sadržaja',         'Broj objava, priča i reels-a u toku meseca. Kratka forma traži najviše vremena po jednoj objavi.'],
    ['Produkcija',            'Snimanje na lokaciji, fotografija proizvoda i montaža. Kada materijal šaljete Vi, u skladu sa tim korigujemo cenu paketa.'],
    ['Odgovaranje na poruke i komentare',  'Obim poruka i komentara i koliko brzo na njih treba odgovoriti. Za profile sa velikim prilivom upita ovo je zaseban posao.'],
    ['Oglašavanje',           'Postavka i optimizacija kampanja su naš rad. Budžet koji ide Meti ili TikTok-u plaćate direktno, sa svog naloga.'],
],
'price_note' => 'U ponudi piše tačan broj objava, priča i reels-a, šta ulazi u produkciju i šta se plaća odvojeno - bez „paketa“ iz kojih ne možete da vidite šta dobijate. Ponudu dobijate u roku od 24 sata - ne naplaćujemo je i ne obavezuje Vas ni na šta.',

'faq_h2'   => 'Česta pitanja o vođenju društvenih mreža u Beogradu <em>-</em>',
'faq_lead' => 'Pitanja koja najčešće čujemo od beogradskih klijenata pre početka saradnje.',
'faq' => [
    ['briefcase', 'Koliko košta vođenje društvenih mreža u Beogradu?',
                  'Zavisi od broja mreža, obima sadržaja i toga da li uz to ide i produkcija (snimanje i montaža). Radimo <strong>mesečno, po tačno definisanom obimu</strong> - bez „paketa“ u koje se ne vidi šta ulazi. Ponudu dobijate u roku od 24 sata.'],
    ['calendar-check', 'Koliko traje dok se vide rezultati?',
                  'Prvi pomaci u dosegu i interakciji vide se obično <strong>posle šest do osam nedelja</strong> doslednog objavljivanja. Za merljiv rast upita i prodaje na beogradskom tržištu računajte na tri do šest meseci, pogotovo ako uz sadržaj ide i oglašavanje.'],
    ['play-fill', 'Da li radite i produkciju sadržaja?',
                  'Da - snimanje i montažu reels-a, fotografije proizvoda i grafičke vizuale. <strong>Dolazimo na lokaciju u Beogradu</strong> po dogovorenom terminu, ili radimo od materijala koji nam Vi pošaljete, uz naše smernice kako da se snimi.'],
    ['diagram-3', 'Koje mreže vodite?',
                  'Instagram, Facebook, TikTok i LinkedIn. <strong>Ne preporučujemo da se bude svuda</strong> - biramo dve do tri mreže na kojima je Vaša publika zaista aktivna i tamo radimo temeljno, umesto da isti sadržaj razvučemo na pet profila.'],
    ['check2-circle', 'Ko piše tekstove i ko odobrava objave?',
                  'Tekstove pišemo mi, u tonu koji zajedno usaglasimo na početku. <strong>Ceo mesečni plan ide Vama na odobrenje pre prve objave</strong>, a izmene pre izlaska su normalan deo procesa. Ako imate internu osobu za marketing, radimo direktno sa njom.'],
    ['cash-coin', 'Da li je oglasni budžet uračunat?',
                  'Nije. Rad na kampanjama je deo naše mesečne naknade, a <strong>budžet koji ide Meti ili TikTok-u plaćate direktno</strong>, sa svog naloga. Tako u svakom trenutku vidite koliko je potrošeno, na koju kampanju i sa kakvim rezultatom.'],
    ['clock',     'Šta ako želimo da prekinemo saradnju?',
                  'Radimo na mesečnom nivou, bez dugoročnog vezivanja. Prekid se najavljuje do kraja tekućeg meseca, a <strong>Vi zadržavate pristup nalozima, sve objavljene materijale i izvorne fajlove</strong> koje smo napravili.'],
    ['graph-up',  'Kakve izveštaje dobijam?',
                  'Mesečni izveštaj sa dosegom, rastom pratilaca, interakcijama, porukama i klikovima ka sajtu, uz poređenje sa prethodnim mesecom. Uz brojeve ide i <strong>kratak zaključak: šta je radilo, šta nije i šta menjamo</strong> - bez tabela iz kojih se ne vidi odluka.'],
],
'area_served' => ['Beograd', 'Novi Beograd', 'Zemun', 'Vračar', 'Stari grad', 'Savski venac', 'Zvezdara', 'Voždovac', 'Palilula', 'Čukarica', 'Rakovica', 'Surčin', 'Srbija'],
],

'en' => [

'serv_h2'   => 'What we do on your channels in Belgrade <em>-</em>',
'serv_lead' => 'We run the profile from strategy through to reporting, with one person responsible for your brand. You approve the plan, everything else is on us, and posts go out on a fixed calendar without interruptions.',
'serv' => [
    ['calendar-check', 'Content plan & posting',   'A monthly calendar with topics, formats and dates, approved before the month begins. The rhythm holds even in the busiest season.'],
    ['palette2',       'Visual design',            'A visual system recognised in the feed before the brand name is even read - graphics, covers, stories and templates for ongoing use.'],
    ['play-fill',      'Reels production',         'Shooting and editing short-form video, at your location or at an agreed time. The editing, subtitles and choice of music are on us.'],
    ['chat-dots',      'Community management',     'Messages, comments and enquiries get an answer during working hours, using pre-agreed replies to the common questions. Anything you need to decide on reaches you without delay.'],
    ['cash-coin',      'Meta and TikTok campaigns','Audience setup, creative testing and optimisation towards the goal - messages, sales or visits to your venue, depending on what you need.'],
    ['graph-up',       'Monthly reports',          'Reach, growth, engagement and clicks compared with the previous month, plus a short conclusion on what delivered results and what we improve in the month ahead.'],
],

'proc_h2'   => 'What the collaboration looks like, from the first call <em>-</em>',
'proc_lead' => 'The process has four steps, a monthly rhythm and a single point of contact. We hold the introductory meeting in person in Belgrade whenever possible - it is the fastest way to understand the brand and the audience it speaks to.',
'proc' => [
    ['Profile and audience analysis', 'We go through the accounts, the statistics and the content so far. We map the audience and review how the strongest competitors in your industry perform.'],
    ['Strategy and content plan',     'We set the goal, choose the two or three channels that genuinely pay off and define the pillars and the tone. You get a plan for the first month and a quote with a precise scope.'],
    ['Production and posting',        'We shoot, design and write, then publish to the calendar. The content goes to you for approval before release, with room for changes.'],
    ['Advertising and reporting',     'Campaigns are set up and optimised through the month, and at the end you receive a report with the results and a plan for the period ahead.'],
],

'ind_h2'   => 'Whose channels we run in Belgrade <em>-</em>',
'ind_lead' => 'We work with brands whose feed is the first point of sale - where the decision is made before anyone even picks up the phone. These are the brands whose profiles we run most often in Belgrade and the surrounding area.',
'ind' => [
    'Restaurants, bars and clubs',
    'Aesthetic and wellness centres',
    'Fitness studios and gyms',
    'Fashion brands and online stores',
    'Clinics and specialist practices',
    'Real estate agencies',
    'Hotels and accommodation',
    'Event and wedding agencies',
    'Online courses and education brands',
    'Cafés and coffee shops',
    'Automotive and dealerships',
    'IT and B2B brands',
],

'price_h2'   => 'How much does social media management in Belgrade cost <em>-</em>',
'price_lead' => 'The fee is monthly and is set according to the scope we agree at the start. These five items determine the price of the package.',
'price' => [
    ['Number of channels',   'Instagram on its own, or combined with Facebook, TikTok and LinkedIn. Content is adapted separately for each channel.'],
    ['Volume of content',    'The number of posts, stories and reels across the month. Short form takes the most time per individual post.'],
    ['Production',           'On-location filming, product photography and editing. When you send the material yourself, we adjust the price of the package accordingly.'],
    ['Community management', 'The volume of messages and comments and how quickly they need answering. For profiles with heavy enquiry traffic this is a job of its own.'],
    ['Advertising',          'Setting up and optimising the campaigns is our work. The budget that goes to Meta or TikTok you pay directly, from your own account.'],
],
'price_note' => 'The quote states the exact number of posts, stories and reels, what production covers and what is paid separately - no “packages” you cannot see into. You receive it within 24 hours - we don’t charge for it and it commits you to nothing.',

'faq_h2'   => 'Frequently asked questions about social media management in Belgrade <em>-</em>',
'faq_lead' => 'The questions we hear most often from Belgrade clients before we start.',
'faq' => [
    ['briefcase', 'How much does social media management in Belgrade cost?',
                  'It depends on the number of channels, the volume of content and whether production (shooting and editing) is included. We work <strong>monthly, with a precisely defined scope</strong> - no “packages” you cannot see into. You receive the quote within 24 hours.'],
    ['calendar-check', 'How long before results show?',
                  'The first movement in reach and engagement is usually visible <strong>after six to eight weeks</strong> of consistent posting. For measurable growth in enquiries and sales in the Belgrade market, count on three to six months, especially if advertising runs alongside the content.'],
    ['play-fill', 'Do you handle content production as well?',
                  'Yes - shooting and editing reels, product photography and graphic visuals. <strong>We come to your location in Belgrade</strong> at an agreed time, or work from material you send us, following a short brief on how to film it.'],
    ['diagram-3', 'Which channels do you manage?',
                  'Instagram, Facebook, TikTok and LinkedIn. <strong>We don’t recommend being everywhere</strong> - we pick the two or three channels where your audience is genuinely active and work them properly, instead of stretching the same content across five profiles.'],
    ['check2-circle', 'Who writes the captions and who approves the posts?',
                  'We write the captions, in a tone we agree on together at the start. <strong>The whole monthly plan goes to you for approval before the first post</strong>, and changes before release are a normal part of the process. If you have an in-house marketing person, we work directly with them.'],
    ['cash-coin', 'Is the ad budget included?',
                  'It isn’t. Campaign work is part of our monthly fee, while <strong>the budget that goes to Meta or TikTok you pay directly</strong>, from your own account. That way you always see how much was spent, on which campaign and with what result.'],
    ['clock',     'What if we want to end the collaboration?',
                  'We work on a monthly basis, with no long-term tie-in. Notice is given by the end of the current month, and <strong>you keep access to the accounts, all published material and the source files</strong> we produced.'],
    ['graph-up',  'What kind of reports do I get?',
                  'A monthly report with reach, follower growth, engagement, messages and clicks to your website, compared with the previous month. Alongside the numbers there is <strong>a short conclusion: what worked, what didn’t and what we are changing</strong> - no tables you cannot draw a decision from.'],
],
'area_served' => ['Belgrade', 'New Belgrade', 'Zemun', 'Vračar', 'Stari grad', 'Savski venac', 'Zvezdara', 'Voždovac', 'Palilula', 'Čukarica', 'Rakovica', 'Surčin', 'Serbia'],
],
],

], /* end social */

/* ────────────────────────────────────────────────────────────────────────────
   MARKETING AGENCIJA (oglašavanje, Google profil, SEO, strategija)
   Razgraničenje: svakodnevni sadržaj i komunikacija sa pratiocima su na
   stranicama za društvene mreže - ovde se pominju samo uz link ka njima.
   ──────────────────────────────────────────────────────────────────────────── */
'marketing' => [

/* ═══ PANČEVO ═══ */
'pancevo' => [
'sr' => [

'serv_h2'   => 'Šta radimo za Vaš marketing u Pančevu <em>-</em>',
'serv_lead' => 'Kanale oglašavanja biramo na osnovu toga gde Vaši potencijalni klijenti pretražuju proizvode i usluge, a ne prema trenutnim trendovima. U zavisnosti od delatnosti, najveći potencijal mogu imati Google Ads kampanje ili optimizovan Google poslovni profil - konkretan predlog dobijate nakon prvog razgovora.',
'serv' => [
    ['search',     'Google Ads kampanje',                     'Planiranje i vođenje Google Ads kampanja usmerenih ka korisnicima iz Pančeva i okoline koji aktivno pretražuju Vaše proizvode i usluge. Kroz kontinuiranu optimizaciju oglasa i budžeta radimo na povećanju broja relevantnih poseta, poziva i upita.'],
    ['cash-coin',  'Meta oglašavanje (Facebook i Instagram)', 'Kreiranje i vođenje oglasnih kampanja na Facebooku i Instagramu, prilagođenih Vašoj ciljnoj grupi i poslovnim ciljevima. Preciznim odabirom publike, kreativnih rešenja i oglasnih formata povećavamo prepoznatljivost brenda i podstičemo interesovanje potencijalnih klijenata.'],
    ['geo-alt',    'Google poslovni profil',                  'Optimizacija Google poslovnog profila radi unapređenja vidljivosti u lokalnim pretragama i na Google mapama. Uređujemo informacije o poslovanju, kategorije, usluge i vizuelni sadržaj, uz strategiju za prikupljanje recenzija i jačanje poverenja potencijalnih klijenata.'],
    ['graph-up',   'SEO optimizacija',                        'Tehnička, sadržajna i lokalna SEO optimizacija web sajta sa ciljem poboljšanja pozicija na Google pretrazi. Unapređujemo strukturu, sadržaj i performanse sajta kako bismo povećali organsku vidljivost i privukli korisnike koji pretražuju Vaše usluge.'],
    ['bar-chart',  'Analitika i praćenje konverzija',         'Implementacija analitičkih alata i praćenja ključnih aktivnosti korisnika, uključujući pozive, poruke i kontakt forme. Analizom prikupljenih podataka utvrđujemo efikasnost kampanja i donosimo odluke o daljoj optimizaciji marketinških ulaganja.'],
    ['diagram-3',  'Marketinška strategija',                  'Razvoj sveobuhvatne marketinške strategije prilagođene Vašem poslovanju, ciljnoj grupi i konkurentskom okruženju. Definišemo komunikacione kanale, ključne poruke, budžet i plan aktivnosti za naredna tri do šest meseci, sa fokusom na ostvarivanje merljivih poslovnih rezultata.'],
],

'proc_h2'   => 'Od prvog razgovora do pokretanja kampanje <em>-</em>',
'proc_lead' => 'Četiri jasno definisana koraka, a prvi upiti se najčešće ostvaruju već tokom prvog meseca. Kampanje se vode na Vašim nalozima, pa podaci i istorija oglašavanja uvek ostaju u Vašem vlasništvu.',
'proc' => [
    ['Analiza poslovanja',       'Upoznajemo Vašu ponudu, cene i ciljnu grupu i analiziramo nastup konkurencije iz Pančeva na Google-u i društvenim mrežama, kao i trenutno stanje Vašeg sajta i Google profila.'],
    ['Strategija i merenje',     'Definišemo kanale, budžet i ciljeve za prvi mesec i postavljamo praćenje poziva, poruka i formi. Nijedna kampanja se ne pokreće bez definisanog sistema merenja.'],
    ['Pokretanje kampanja',      'Pripremamo tekstove oglasa i vizuale i podešavamo ciljnu publiku. Tokom prvih nedelja kontinuirano pratimo rezultate i prilagođavamo kampanje u skladu sa ostvarenim učinkom.'],
    ['Izveštavanje i optimizacija', 'Na kraju svakog meseca dostavljamo izveštaj sa troškovima, brojem upita i cenom po kontaktu, uz konkretne predloge za dalje unapređenje kampanja.'],
],

'ind_h2'   => 'Za koga radimo marketing u Pančevu <em>-</em>',
'ind_lead' => 'Najbrže rezultate ostvaruju delatnosti kod kojih potencijalni klijenti traže uslugu u svojoj blizini i odluku donose brzo. U nastavku su oblasti iz Pančeva i okoline za koje najčešće realizujemo kampanje.',
'ind' => [
    'Majstori, vodoinstalateri i električari',
    'Stomatološke i lekarske ordinacije',
    'Auto-servisi i vulkanizeri',
    'Restorani i dostava hrane',
    'Saloni lepote i kozmetički studiji',
    'Advokati i knjigovodstvene agencije',
    'Teretane i sportski klubovi',
    'Nekretnine i građevinske firme',
    'Škole, kursevi i obuke',
    'Prodavnice i online prodavnice',
    'Smeštaj, apartmani i turizam',
    'Proizvođači i distributeri',
],

'price_h2'   => 'Koliko košta marketing za firmu u Pančevu <em>-</em>',
'price_lead' => 'Cena saradnje sastoji se iz naše mesečne naknade i budžeta za oglase, koji uplaćujete direktno Google-u i Meti sa svog naloga. Visinu oba iznosa određuju sledeće stavke.',
'price' => [
    ['Broj kanala',               'Obim posla zavisi od toga da li se kampanje vode samo na Google-u ili u kombinaciji sa Meta oglašavanjem i SEO optimizacijom, jer svaki kanal zahteva posebna podešavanja, kreativna rešenja i praćenje.'],
    ['Budžet za oglase',          'Iznos zavisi isključivo od rezultata koje želite da postignete, kao i broja kanala na kojima se vrši komunikacija. Preporuku dajemo nakon detaljne analize, kako bismo definisali optimalni ulog koji će doneti očekivane rezultate.'],
    ['Izrada kreativnih rešenja', 'Tekstovi oglasa, grafike i kratki video formati. Ukoliko raspolažete sopstvenim fotografijama i video materijalom, koristimo ih; u suprotnom, kompletnu pripremu materijala preuzimamo mi.'],
    ['Početno podešavanje',       'Otvaranje naloga, podešavanje merenja konverzija i optimizacija Google profila realizuju se jednokratno, na početku saradnje.'],
    ['Obim izveštavanja',         'Mesečni izveštaj je uvek uključen, dok se nedeljni pregledi i sastanci uživo dogovaraju prema potrebi.'],
],
'price_note' => 'Našu naknadu i budžet za oglase uvek prikazujemo odvojeno, kako biste imali potpun uvid u strukturu ulaganja. Nakon kratkog razgovora dostavljamo pisanu ponudu sa predlogom budžeta i ciljevima za prvi mesec - u roku od 24 sata, bez naknade i bez obaveze.',

'rev' => true,   // sekcija „Šta kažu klijenti“ (partials/testimonials.php)

'faq_h2'   => 'Česta pitanja o marketingu u Pančevu <em>-</em>',
'faq_lead' => 'Odgovori na pitanja koja vlasnici firmi iz Pančeva najčešće postavljaju pre pokretanja oglašavanja.',
'faq' => [
    ['star-fill',  'Zašto angažovati agenciju umesto samostalnog vođenja oglasa?',
                   'Pokretanje oglasa je tehnički jednostavno, ali bez stručnog podešavanja budžet se lako troši bez rezultata. Postavljamo merenje, testiramo više verzija oglasa i redovno optimizujemo kampanje, kako bi isto ulaganje donelo <strong>više poziva i upita</strong>, a Vi više vremena posvetili svom poslovanju.'],
    ['briefcase',  'Koliki je budžet za oglase potreban u Pančevu?',
                   'Visina budžeta zavisi od delatnosti i nivoa konkurencije. Lokalno tržište je manje od beogradskog, pa je cena klika često niža. U prvom mesecu kampanje pokrećemo sa umerenim budžetom, koji povećavamo kada utvrdimo <strong>kolika je cena jednog upita</strong>.'],
    ['clock',      'Kada mogu da očekujem prve rezultate?',
                   'Google Ads i Meta kampanje donose prve upite već tokom prvih nedelja. Rezultati SEO optimizacije i Google profila dolaze postepeno - realno je očekivati dva do tri meseca do <strong>stabilnih pozicija na pretrazi</strong>.'],
    ['geo-alt',    'Da li optimizujete i Google poslovni profil?',
                   'Da, i preporučujemo ga kao jedan od prvih koraka. Za pretrage poput „frizer Pančevo“ Google najpre prikazuje mapu sa tri firme, a <strong>optimizovan profil sa recenzijama</strong> ima presudan uticaj na to koje će se firme tu pojaviti.'],
    ['chat-dots',  'Da li vodite i društvene mreže?',
                   'Da, kao zasebnu uslugu - oglašavanje, svakodnevno kreiranje sadržaja i komunikacija sa pratiocima predstavljaju različite segmente posla. Više o tome kako izgleda kompletno <a href="{lp_social_pancevo}">vođenje društvenih mreža u Pančevu</a> pročitajte na posebnoj stranici.'],
    ['code-slash', 'Da li je potreban novi sajt da bi oglasi bili uspešni?',
                   'Ne nužno. Ukoliko je sajt brz, prilagođen mobilnim uređajima i ima jasan poziv na akciju, oglasi mogu odmah da vode ka njemu. U suprotnom, isti tim realizuje i <a href="{lp_web_pancevo}">izradu web sajta u Pančevu</a>, kako bi kampanja i stranica činile funkcionalnu celinu.'],
    ['person',     'Na čije ime se otvaraju nalozi za oglašavanje?',
                   'Na ime Vaše firme. Google Ads, Meta nalog i Google poslovni profil su u Vašem vlasništvu, a mi im pristupamo kao saradnici. <strong>U slučaju prestanka saradnje, sve kampanje i podaci ostaju Vama.</strong>'],
    ['graph-up',   'Kako mogu da pratim isplativost marketinga?',
                   'Svakog meseca dobijate izveštaj sa ključnim pokazateljima: <strong>potrošenim budžetom, brojem poziva i upita i cenom jednog kontakta</strong>. Na osnovu tih podataka zajedno donosimo odluke o daljim koracima i raspodeli budžeta.'],
],
'area_served' => ['Pančevo', 'Starčevo', 'Omoljica', 'Jabuka', 'Kačarevo', 'Dolovo', 'Opovo', 'Kovačica', 'Kovin', 'Alibunar', 'Vršac', 'Južnobanatski okrug', 'Beograd', 'Srbija'],
],

'en' => [

'serv_h2'   => 'What we do for your marketing in Pančevo <em>-</em>',
'serv_lead' => 'We choose advertising channels based on where your potential clients search for products and services, not on current trends. Depending on the industry, Google Ads campaigns or an optimised Google Business Profile may hold the greatest potential - you receive a concrete recommendation after the first conversation.',
'serv' => [
    ['search',     'Google Ads campaigns',                    'Planning and managing Google Ads campaigns aimed at users in Pančevo and the surrounding area who are actively searching for your products and services. Through continuous optimisation of ads and budget, we work to increase the number of relevant visits, calls and enquiries.'],
    ['cash-coin',  'Meta advertising (Facebook and Instagram)', 'Creating and managing advertising campaigns on Facebook and Instagram, tailored to your target audience and business goals. Through precise selection of audience, creative and ad formats, we increase brand awareness and generate interest among potential clients.'],
    ['geo-alt',    'Google Business Profile',                 'Optimising your Google Business Profile to improve visibility in local search and on Google Maps. We refine business information, categories, services and visual content, with a strategy for collecting reviews and building the trust of potential clients.'],
    ['graph-up',   'SEO optimisation',                        'Technical, content and local SEO for your website, aimed at improving rankings in Google Search. We improve the site’s structure, content and performance to increase organic visibility and attract users searching for your services.'],
    ['bar-chart',  'Analytics and conversion tracking',       'Implementing analytics tools and tracking key user actions, including calls, messages and contact forms. By analysing the data collected, we assess campaign effectiveness and make decisions on further optimisation of your marketing investment.'],
    ['diagram-3',  'Marketing strategy',                      'Developing a comprehensive marketing strategy tailored to your business, target audience and competitive environment. We define communication channels, key messages, budget and an activity plan for the next three to six months, with a focus on achieving measurable business results.'],
],

'proc_h2'   => 'From the first conversation to campaign launch <em>-</em>',
'proc_lead' => 'Four clearly defined steps, with the first enquiries usually achieved during the first month. Campaigns run in your own accounts, so the data and advertising history always remain your property.',
'proc' => [
    ['Business analysis',         'We learn about your offer, prices and target audience and analyse how competitors in Pančevo present themselves on Google and social media, as well as the current state of your website and Google profile.'],
    ['Strategy and tracking',     'We define channels, budget and goals for the first month and set up tracking for calls, messages and forms. No campaign is launched without a defined measurement system.'],
    ['Launching campaigns',       'We prepare ad copy and visuals and set up the target audience. During the first weeks we monitor results continuously and adjust campaigns according to their performance.'],
    ['Reporting and optimisation', 'At the end of every month we deliver a report with costs, number of enquiries and cost per contact, along with concrete recommendations for further campaign improvement.'],
],

'ind_h2'   => 'Who we do marketing for in Pančevo <em>-</em>',
'ind_lead' => 'The fastest results come in industries where potential clients look for a service nearby and make decisions quickly. Below are the sectors in Pančevo and the surrounding area for which we most often run campaigns.',
'ind' => [
    'Tradespeople, plumbers and electricians',
    'Dental and medical practices',
    'Car services and tyre shops',
    'Restaurants and food delivery',
    'Beauty salons and cosmetic studios',
    'Lawyers and accounting firms',
    'Gyms and sports clubs',
    'Property and construction companies',
    'Schools, courses and training',
    'Shops and online shops',
    'Accommodation, apartments and tourism',
    'Manufacturers and distributors',
],

'price_h2'   => 'How much marketing costs for a business in Pančevo <em>-</em>',
'price_lead' => 'The cost of working together consists of our monthly fee and the ad budget, which you pay directly to Google and Meta from your own account. The following items determine both amounts.',
'price' => [
    ['Number of channels',  'The scope of work depends on whether campaigns run on Google alone or in combination with Meta advertising and SEO, as each channel requires its own setup, creative and tracking.'],
    ['Ad budget',           'The amount depends entirely on the results you want to achieve and on the number of channels used for communication. We make a recommendation after a detailed analysis, so we can define the optimal investment that will deliver the expected results.'],
    ['Creative production', 'Ad copy, graphics and short video formats. If you have your own photos and video material, we use them; otherwise, we take care of preparing all materials.'],
    ['Initial setup',       'Opening accounts, setting up conversion tracking and optimising your Google profile are carried out once, at the start of the collaboration.'],
    ['Reporting scope',     'A monthly report is always included, while weekly reviews and in-person meetings are arranged as needed.'],
],
'price_note' => 'We always show our fee and the ad budget separately, so you have full insight into how your investment is structured. After a short conversation we send a written quote with a proposed budget and goals for the first month - within 24 hours, free of charge and with no obligation.',

'rev' => true,

'faq_h2'   => 'Frequently asked questions about marketing in Pančevo <em>-</em>',
'faq_lead' => 'Answers to the questions business owners in Pančevo most often ask before they start advertising.',
'faq' => [
    ['star-fill',  'Why hire an agency instead of running ads yourself?',
                   'Launching an ad is technically simple, but without expert setup the budget is easily spent without results. We set up tracking, test several ad versions and optimise campaigns regularly, so the same investment brings <strong>more calls and enquiries</strong> and you can devote more time to your business.'],
    ['briefcase',  'What ad budget is needed in Pančevo?',
                   'The budget depends on the industry and the level of competition. The local market is smaller than Belgrade, so the cost per click is often lower. In the first month we launch campaigns with a moderate budget and increase it once we establish <strong>what one enquiry costs</strong>.'],
    ['clock',      'When can I expect the first results?',
                   'Google Ads and Meta campaigns bring the first enquiries within the first few weeks. Results from SEO and the Google profile come gradually - it is realistic to expect two to three months to reach <strong>stable search rankings</strong>.'],
    ['geo-alt',    'Do you also optimise the Google Business Profile?',
                   'Yes, and we recommend it as one of the first steps. For searches such as “hairdresser Pančevo” Google first shows a map with three businesses, and <strong>an optimised profile with reviews</strong> has a decisive influence on which businesses appear there.'],
    ['chat-dots',  'Do you also manage social media?',
                   'Yes, as a separate service - advertising, day-to-day content creation and communication with followers are different areas of work. Read more about what full <a href="{lp_social_pancevo}">social media management in Pančevo</a> involves on a separate page.'],
    ['code-slash', 'Do I need a new website for the ads to succeed?',
                   'Not necessarily. If your site is fast, mobile-friendly and has a clear call to action, ads can point to it straight away. Otherwise, the same team also handles <a href="{lp_web_pancevo}">website development in Pančevo</a>, so the campaign and the page form a functional whole.'],
    ['person',     'Whose name are the advertising accounts opened in?',
                   'Your company’s. Google Ads, the Meta account and the Google Business Profile are your property, and we access them as partners. <strong>If the collaboration ends, all campaigns and data remain yours.</strong>'],
    ['graph-up',   'How can I track whether marketing pays off?',
                   'Every month you receive a report with the key indicators: <strong>budget spent, number of calls and enquiries and the cost of one contact</strong>. Based on that data, we make decisions together about next steps and budget allocation.'],
],
'area_served' => ['Pančevo', 'Starčevo', 'Omoljica', 'Jabuka', 'Kačarevo', 'Dolovo', 'Opovo', 'Kovačica', 'Kovin', 'Alibunar', 'Vršac', 'South Banat District', 'Belgrade', 'Serbia'],
],
],

/* ═══ BEOGRAD ═══ */
'beograd' => [
'sr' => [

'serv_h2'   => 'Usluge digitalnog marketinga za firme u Beogradu <em>-</em>',
'serv_lead' => 'Kanale komunikacije biramo u skladu sa ciljem kampanje - prodajom, upitima ili jačanjem prepoznatljivosti brenda - i nivoom konkurencije u Vašoj delatnosti. Svaki kanal ima jasno definisanu ulogu u okviru strategije.',
'serv' => [
    ['search',       'Google Ads i Performance Max', 'Kampanje na Google pretrazi, YouTube-u i prikazivačkoj mreži, usmerene na korisnike koji aktivno upoređuju ponude. Fokus je na upitima i prodaji, uz kontinuiranu kontrolu cene po kliku.'],
    ['cash-coin',    'Meta i TikTok kampanje',       'Oglašavanje na Facebook-u, Instagramu i TikTok-u, uz testiranje više kreativnih rešenja na beogradskoj publici. Budžet usmeravamo ka oglasima koji ostvaruju najbolje rezultate.'],
    ['arrow-repeat', 'Remarketing',                  'Ponovno obraćanje korisnicima koji su posetili Vaš sajt ili profil, a nisu ostvarili kontakt. Remarketing najčešće donosi upite po najnižoj ceni u okviru kampanje.'],
    ['graph-up',     'SEO optimizacija',             'Tehnička optimizacija, struktura sadržaja i lokalni signali za konkurentne pretrage, na kojima je stabilnu vidljivost teško ostvariti samo putem oglasa.'],
    ['bar-chart',    'Merenje i izveštavanje',       'Google Analytics 4, Google Tag Manager i praćenje konverzija - precizan uvid u vrednost svakog kanala i učinak svake poruke.'],
    ['diagram-3',    'Strategija i medija plan',     'Raspodela budžeta po kanalima i periodima, uz jasno definisane i merljive ciljeve. Plan redovno prilagođavamo na osnovu ostvarenih rezultata.'],
],

'proc_h2'   => 'Proces saradnje na kampanjama <em>-</em>',
'proc_lead' => 'Četiri faze, svaka sa jasno definisanim ciljem - od analize postojećeg stanja do kontinuirane optimizacije. Sastanke organizujemo uživo ili online, u skladu sa Vašim potrebama.',
'proc' => [
    ['Analiza naloga i tržišta',      'Analiziramo postojeće kampanje, sajt i analitiku, kao i način na koji se oglašavaju konkurenti u Beogradu. Dobijate pisani izveštaj sa prioritetnim preporukama.'],
    ['Strategija i budžet',           'Definišemo ciljeve, ciljnu publiku i raspodelu budžeta po kanalima. Pre pokretanja kampanja postavljamo merenje konverzija, kako bi rezultati bili praćeni od prvog dana.'],
    ['Kreativna rešenja i pokretanje','Pripremamo tekstove oglasa, vizuale i video materijale, a kampanje pokrećemo sa više varijanti poruke kako bismo brzo utvrdili koja ostvaruje najbolje rezultate.'],
    ['Optimizacija i rast',           'Kampanje redovno prilagođavamo - ponude, ciljnu publiku i kreativna rešenja. Kada utvrdimo kombinaciju koja je isplativa, budžet postepeno povećavamo.'],
],

'ind_h2'   => 'Delatnosti sa kojima sarađujemo u Beogradu <em>-</em>',
'ind_lead' => 'Kampanje realizujemo za firme koje posluju lokalno, kao i za one koje klijente pronalaze na teritoriji cele Srbije. U nastavku su oblasti u kojima najčešće sarađujemo sa beogradskim klijentima.',
'ind' => [
    'Pravne i konsultantske kancelarije',
    'Privatne klinike i stomatologija',
    'Online prodavnice i e-commerce',
    'Nekretnine i investitori',
    'IT firme i B2B usluge',
    'Ugostiteljstvo i kafeterije',
    'Fitnes i wellness centri',
    'Edukacija i online kursevi',
    'Auto-kuće i rent-a-car',
    'Organizacija proslava i venčanja',
    'Estetika, kozmetika i nega',
    'Turističke agencije i hoteli',
],

'price_h2'   => 'Koliko košta marketing agencija u Beogradu <em>-</em>',
'price_lead' => 'Ukupno ulaganje čine dve stavke: mesečna naknada agencije i medijski budžet koji se plaća direktno platformama za oglašavanje. Na visinu oba iznosa najviše utiču sledeći faktori.',
'price' => [
    ['Kanali i tržište',       'Obim posla zavisi od broja kanala i geografskog obuhvata - kampanja usmerena samo na Beograd razlikuje se od kampanje za celu Srbiju.'],
    ['Medijski budžet',        'Zbog izražene konkurencije na beogradskom tržištu, budžet mora biti realno postavljen. Predlog definišemo na osnovu podataka o Vašoj delatnosti i postavljenim ciljevima.'],
    ['Kreativna rešenja',      'Broj oglasa, banera i video formata koje pripremamo i redovno osvežavamo, kako bi komunikacija ostala relevantna za ciljnu publiku.'],
    ['Merenje i integracije',  'Povezivanje sa CRM sistemom, online prodavnicom ili sistemom za rezervacije realizuje se jednokratno, ali značajno doprinosi tačnosti izveštaja.'],
    ['SEO i sadržaj',          'Ukoliko uz kampanje radimo i SEO optimizaciju, cena obuhvata izradu sadržaja i tehnička unapređenja sajta koja se sprovode na mesečnom nivou.'],
],
'price_note' => 'Ponuda jasno razdvaja naknadu agencije od medijskog budžeta i precizno navodi aktivnosti koje se sprovode svakog meseca. Dostavljamo je u roku od 24 sata nakon razgovora, uz predlog budžeta usklađen sa ciljevima i mogućnostima Vašeg poslovanja.',

'rev' => true,   // sekcija „Šta kažu klijenti“ (partials/testimonials.php) - zahtev korisnika 2026-10-22

'faq_h2'   => 'Česta pitanja o digitalnom marketingu u Beogradu <em>-</em>',
'faq_lead' => 'Odgovori na pitanja koja nam firme iz Beograda najčešće postavljaju pre pokretanja prve kampanje.',
'faq' => [
    ['star-fill',    'Zašto izabrati VUG za digitalni marketing u Beogradu?',
                     'Svaki projekat vodi osoba koja poznaje Vaše poslovanje i sa kojom komunicirate direktno. Kampanje gradimo na osnovu merenja i <strong>cene po upitu</strong>, a ne na osnovu dosega i prikaza koji ne odražavaju stvarne poslovne rezultate.'],
    ['briefcase',    'Koliko košta oglašavanje na Google-u u Beogradu?',
                     'Cena po kliku zavisi od delatnosti - za pojedine pojmove je niska, dok kod konkurentnih usluga, poput pravnih ili medicinskih, može biti višestruko viša. Zato pre pokretanja kampanje procenjujemo <strong>koliko upita je realno ostvariti sa predviđenim budžetom</strong>, a zatim predlažemo optimalan iznos.'],
    ['clock',        'Kada kampanje počinju da donose rezultate?',
                     'Plaćene kampanje najčešće donose prve upite u prvih nekoliko nedelja, dok prvih mesec do dva služe za utvrđivanje najefikasnije kombinacije publike i poruke. SEO optimizacija je dugoročan proces, a značajniji rast vidljivosti očekuje se nakon <strong>tri do šest meseci</strong>.'],
    ['arrow-repeat', 'Da li možete da preuzmete postojeće kampanje?',
                     'Možemo. Najpre sprovodimo analizu postojećih kampanja i analitike, zadržavamo ono što ostvaruje rezultate i unapređujemo segmente koji ne opravdavaju ulaganje. <strong>Istorija naloga se zadržava</strong>, jer doprinosi efikasnosti algoritama za oglašavanje.'],
    ['globe',        'Da li realizujete kampanje i za druge gradove u Srbiji?',
                     'Da. Ciljanje podešavamo prema lokacijama na kojima se nalaze Vaši klijenti - jedan grad, više opština ili cela Srbija - i <strong>pratimo rezultate po lokaciji</strong>, kako bi budžet bio usmeren tamo gde ostvaruje najveći povraćaj.'],
    ['person',       'Ko je vlasnik naloga i podataka?',
                     'Vi. Nalozi za Google Ads, Meta i Google Analytics otvaraju se na Vašu firmu, a mi im pristupamo kao saradnici. U slučaju prestanka saradnje, <strong>svi nalozi i podaci ostaju u Vašem vlasništvu</strong>.'],
    ['tag',          'Da li je potrebno potpisati dugoročan ugovor?',
                     'Ne. Saradnja se ugovara na mesečnom nivou, uz preporuku da se kampanjama obezbedi period od najmanje tri meseca, koliko je potrebno da se <strong>prikupe relevantni podaci i stabilizuju rezultati</strong>.'],
    ['graph-up',     'Šta sadrži mesečni izveštaj?',
                     'Izveštaj je pregledan i fokusiran na poslovne rezultate: troškove po kanalu, broj poziva, upita i kupovina, cenu po kontaktu i poređenje sa prethodnim periodom. Uz rezultate dobijate i <strong>plan optimizacije za naredni mesec</strong>.'],
],
'area_served' => ['Beograd', 'Novi Beograd', 'Zemun', 'Vračar', 'Stari grad', 'Savski venac', 'Zvezdara', 'Voždovac', 'Palilula', 'Čukarica', 'Rakovica', 'Surčin', 'Srbija'],
],

'en' => [

'serv_h2'   => 'Digital marketing services for Belgrade businesses <em>-</em>',
'serv_lead' => 'We select communication channels according to the campaign goal - sales, enquiries or brand awareness - and the level of competition in your industry. Each channel has a clearly defined role within the strategy.',
'serv' => [
    ['search',       'Google Ads and Performance Max', 'Campaigns on Google Search, YouTube and the Display Network, aimed at users actively comparing offers. The focus is on enquiries and sales, with continuous control of cost per click.'],
    ['cash-coin',    'Meta and TikTok campaigns',      'Advertising on Facebook, Instagram and TikTok, testing several creative approaches with a Belgrade audience. We direct the budget towards the ads that achieve the best results.'],
    ['arrow-repeat', 'Remarketing',                    'Re-engaging users who visited your website or profile without getting in touch. Remarketing typically delivers the lowest cost per enquiry within a campaign.'],
    ['graph-up',     'SEO optimisation',               'Technical optimisation, content structure and local signals for competitive searches, where stable visibility is difficult to achieve through ads alone.'],
    ['bar-chart',    'Tracking and reporting',         'Google Analytics 4, Google Tag Manager and conversion tracking - precise insight into the value of each channel and the performance of each message.'],
    ['diagram-3',    'Strategy and media plan',        'Budget allocation by channel and period, with clearly defined, measurable goals. We adjust the plan regularly based on the results achieved.'],
],

'proc_h2'   => 'Our campaign collaboration process <em>-</em>',
'proc_lead' => 'Four phases, each with a clearly defined goal - from an analysis of the current situation to continuous optimisation. Meetings take place in person or online, according to your needs.',
'proc' => [
    ['Account and market analysis', 'We analyse existing campaigns, the website and analytics, as well as how competitors in Belgrade advertise. You receive a written report with prioritised recommendations.'],
    ['Strategy and budget',         'We define goals, target audience and budget allocation across channels. Before campaigns launch we set up conversion tracking, so results are monitored from day one.'],
    ['Creative and launch',         'We prepare ad copy, visuals and video, and launch campaigns with several message variants to quickly establish which one performs best.'],
    ['Optimisation and growth',     'We adjust campaigns regularly - bids, target audience and creative. Once we identify a profitable combination, we increase the budget gradually.'],
],

'ind_h2'   => 'Industries we work with in Belgrade <em>-</em>',
'ind_lead' => 'We run campaigns for companies that operate locally as well as those that find clients across Serbia. Below are the sectors in which we most often work with Belgrade clients.',
'ind' => [
    'Law and consulting firms',
    'Private clinics and dentistry',
    'Online shops and e-commerce',
    'Property and investors',
    'IT companies and B2B services',
    'Hospitality and cafés',
    'Fitness and wellness centres',
    'Education and online courses',
    'Car dealerships and rent-a-car',
    'Party and wedding planning',
    'Aesthetics, cosmetics and care',
    'Travel agencies and hotels',
],

'price_h2'   => 'How much a marketing agency in Belgrade costs <em>-</em>',
'price_lead' => 'The total investment consists of two items: the agency’s monthly fee and the media budget paid directly to the advertising platforms. The following factors have the greatest effect on both amounts.',
'price' => [
    ['Channels and market',       'The scope of work depends on the number of channels and the geographic reach - a campaign targeting Belgrade alone differs from one covering the whole of Serbia.'],
    ['Media budget',              'Given the strong competition in the Belgrade market, the budget must be set realistically. We define our proposal based on data about your industry and your goals.'],
    ['Creative',                  'The number of ads, banners and video formats we prepare and refresh regularly, so communication stays relevant to the target audience.'],
    ['Tracking and integrations', 'Connecting to a CRM, online shop or booking system is a one-off task, but it contributes significantly to the accuracy of reporting.'],
    ['SEO and content',           'If we also handle SEO alongside the campaigns, the price includes content creation and technical website improvements carried out every month.'],
],
'price_note' => 'The quote clearly separates the agency fee from the media budget and specifies the activities carried out each month. We send it within 24 hours of our conversation, with a budget proposal aligned with the goals and capacity of your business.',

'rev' => true,

'faq_h2'   => 'Frequently asked questions about digital marketing in Belgrade <em>-</em>',
'faq_lead' => 'Answers to the questions Belgrade companies most often ask us before launching their first campaign.',
'faq' => [
    ['star-fill',    'Why choose VUG for digital marketing in Belgrade?',
                     'Every project is managed by a person who knows your business and with whom you communicate directly. We build campaigns on tracking and <strong>cost per enquiry</strong>, rather than on reach and impressions that do not reflect real business results.'],
    ['briefcase',    'How much does Google advertising cost in Belgrade?',
                     'Cost per click depends on the industry - for some terms it is low, while for competitive services such as legal or medical ones it can be several times higher. That is why, before launching a campaign, we estimate <strong>how many enquiries can realistically be achieved with the planned budget</strong>, and then propose the optimal amount.'],
    ['clock',        'When do campaigns start delivering results?',
                     'Paid campaigns usually bring the first enquiries within the first few weeks, while the first month or two is used to establish the most effective combination of audience and message. SEO is a long-term process, and more significant growth in visibility is expected after <strong>three to six months</strong>.'],
    ['arrow-repeat', 'Can you take over existing campaigns?',
                     'Yes. We first analyse the existing campaigns and analytics, keep what is delivering results and improve the areas that do not justify the investment. <strong>Account history is retained</strong>, as it contributes to the efficiency of the advertising algorithms.'],
    ['globe',        'Do you run campaigns for other cities in Serbia too?',
                     'Yes. We set targeting according to where your clients are - one city, several municipalities or the whole of Serbia - and <strong>track results by location</strong>, so the budget is directed where it achieves the greatest return.'],
    ['person',       'Who owns the accounts and data?',
                     'You do. Google Ads, Meta and Google Analytics accounts are opened in your company’s name, and we access them as partners. If the collaboration ends, <strong>all accounts and data remain your property</strong>.'],
    ['tag',          'Is a long-term contract required?',
                     'No. The collaboration is agreed on a monthly basis, with a recommendation to allow campaigns at least three months, which is the time needed to <strong>gather relevant data and stabilise results</strong>.'],
    ['graph-up',     'What does the monthly report contain?',
                     'The report is clear and focused on business results: costs by channel, number of calls, enquiries and purchases, cost per contact and a comparison with the previous period. Alongside the results you receive <strong>an optimisation plan for the following month</strong>.'],
],
'area_served' => ['Belgrade', 'New Belgrade', 'Zemun', 'Vračar', 'Stari grad', 'Savski venac', 'Zvezdara', 'Voždovac', 'Palilula', 'Čukarica', 'Rakovica', 'Surčin', 'Serbia'],
],
],

], /* end marketing */

], /* end city */

];