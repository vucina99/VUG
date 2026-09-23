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
 * 'faq', 'local'). Zato 'social' trenutno ima samo FAQ + lokalni blok, a 'web'
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
    ['Lansiranje i podrška',  'Postavljamo sajt na domen, povezujemo Google Analytics, Search Console i poslovni profil, i pokazujemo Vam kako da upravljate Vašim web sajtom. Posle toga ostajemo dostupni.'],
],

'ind_h2'   => 'Za koga pravimo sajtove u Pančevu <em>-</em>',
'ind_lead' => 'Ne ograničavamo se na jednu industriju. Naš pristup prilagođavamo svakom poslovanju koje želi veću vidljivost i bolju prisutnost na tržištu. Ovo su delatnosti sa kojima najčešće sarađujemo u Pančevu i južnom Banatu.',
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
'price_note' => 'Ne naplaćujemo „po satu, videćemo koliko ispadne“. Posle kratkog razgovora - telefonom ili uživo - dobijate pisanu ponudu sa fiksnom cenom, rokom i tačnim spiskom onoga što ulazi u posao. Ponuda stiže u roku od 48 sati, besplatna je i ne stvara nikakve obaveze prema nama.',

'faq_h2'   => 'Česta pitanja o izradi sajta u Pančevu <em>-</em>',
'faq_lead' => 'Pitanja koja nam klijenti iz Pančeva postavljaju na prvom sastanku. Ako Vaše nije na spisku, javite se - odgovaramo isti dan.',
'faq' => [
    ['briefcase',      'Koliko košta izrada web sajta u Pančevu?',
                       'Cena zavisi od obima: broja stranica, da li je dizajn po meri ili prilagođen, i da li sajt ima prodavnicu, rezervacije ili druge funkcionalnosti. Zato ne objavljujemo cenovnik „od“ - posle kratkog razgovora dobijate <strong>pisanu ponudu sa fiksnom cenom i rokom</strong>, bez skrivenih troškova. Procena stiže u roku od 48 sati i ne obavezuje Vas.'],
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
    ['cart',         'Online stores',                 'A web shop adapted to the local buyer - cash on delivery and card payments, shipping calculation, coupons and a clear admin panel you can run yourself.'],
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
'ind_lead' => 'We don’t limit ourselves to a single industry. We adapt our approach to every business that wants greater visibility and a stronger presence in its market. These are the industries we work with most often in Pančevo and southern Banat.',
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
    'Agriculture, buy-back and machinery',
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
'price_note' => 'We don’t charge “by the hour, we’ll see how it turns out”. After a short conversation - by phone or in person - you receive a written quote with a fixed price, a deadline and an exact list of what the job includes. The quote arrives within 48 hours, is free of charge and creates no obligation toward us.',

'faq_h2'   => 'Frequently asked questions about websites in Pančevo <em>-</em>',
'faq_lead' => 'The questions clients from Pančevo ask us at the first meeting. If yours isn’t on the list, get in touch - we reply the same day.',
'faq' => [
    ['briefcase',      'How much does a website in Pančevo cost?',
                       'The price depends on the scope: the number of pages, whether the design is custom or adapted, and whether the site has a store, booking or other functionality. That is why we don’t publish a “starting from” price list - after a short conversation you receive a <strong>written quote with a fixed price and deadline</strong>, with no hidden costs. The estimate arrives within 48 hours and commits you to nothing.'],
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
    ['Razgovor i analiza',   'Definišemo cilj: više upita, veća prodaja ili ozbiljniji utisak pred klijentima. Istražimo Vašu publiku i konkurenciju na beogradskom tržištu i nalazimo prostor u kojem se možete izdvojiti.'],
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
    'Event i marketing agencije',
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
'price_note' => 'Nakon uvodnog razgovora - uživo u Beogradu ili preko video poziva - dobijate pisanu ponudu sa fiksnom cenom, rokovima po fazama i tačnim spiskom onoga što ulazi u posao. Ponuda stiže u roku od 48 sati, besplatna je, napisana tako da možete da je uporedite sa bilo kojom drugom, i ne stvara nikakve obaveze prema nama.',

'faq_h2'   => 'Česta pitanja o izradi sajta u Beogradu <em>-</em>',
'faq_lead' => 'Pitanja koja najčešće čujemo od beogradskih klijenata pre potpisivanja. Ako Vaše nije ovde, javite se - odgovaramo istog dana.',
'faq' => [
    ['briefcase',      'Koliko košta izrada web sajta u Beogradu?',
                       'Cena zavisi od obima, složenosti funkcionalnosti i toga da li je dizajn po meri. Zato ne objavljujemo cenovnik „od“ - on na beogradskom tržištu ionako ne znači ništa dok se ne zna šta sajt treba da radi. Posle kratkog razgovora dobijate <strong>pisanu ponudu sa fiksnom cenom, rokovima po fazama i spiskom svega što ulazi u posao</strong>, u roku od 48 sati.'],
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
'serv_lead' => 'On the Belgrade market, what wins is work that is finished properly. We run strategy, design, build and optimisation in-house, with clearly defined roles and one person responsible for your project from start to finish.',
'serv' => [
    ['code-slash',   'Websites and web applications', 'We build brochure sites, online catalogues and web applications shaped around the specific needs of your business. Every solution is developed individually, with a focus on speed, functionality and a distinctive visual identity.'],
    ['cart',         'Online stores',                 'A web shop ready for serious volume: filters, product variants, integration with courier services and your invoicing system, plus sales analytics.'],
    ['arrow-repeat', 'Redesign of an existing site',  'For companies that already have traffic but lose customers to a dated design and slow loading. Search positions are preserved - the impression and the conversion rate go up.'],
    ['search',       'SEO optimisation',              'We optimise the site to be more visible in local Google searches and connected to your business profile, so people find you more easily when they search for exactly what you offer.'],
    ['tools',        'Maintenance and support',       'Regular maintenance, security checks, backups and timely changes, so your site is always stable, up to date and ready to support your day-to-day business.'],
    ['palette2',     'Branding and graphic design',   'A visual identity that gives your brand a consistent, professional look - from the logo, colours and typography through to presentations and campaign materials.'],
],

'proc_h2'   => 'What the project looks like, from call to launch <em>-</em>',
'proc_lead' => 'The process is split into four clear steps, with defined deadlines and a single point of contact throughout. The introductory meeting can be held in person or online, but where possible we choose to meet in person, as it gives us a better insight into your business and your goals.',
'proc' => [
    ['Conversation and analysis', 'We define the goal: more enquiries, more sales or a more serious impression in front of clients. We research your audience and the competition on the Belgrade market and find the space where you can stand out.'],
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
    'Online stores and distributors',
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
    ['Content and strategy','Copy written to sell, photography, translation and the SEO structure. On a competitive market this is often the difference between a site that works and a site that merely exists.'],
    ['What comes after launch', 'The cost of hosting, the domain and the advertising budget is not part of our fee and is paid directly to the providers you choose. You receive all the approximate costs in advance, together with the quote.'],
],
'price_note' => 'After an introductory conversation - in person in Belgrade or over a video call - you receive a written quote with a fixed price, deadlines per phase and an exact list of what the job includes. The quote arrives within 48 hours, is free of charge, written so you can compare it with any other, and creates no obligation toward us.',

'faq_h2'   => 'Frequently asked questions about websites in Belgrade <em>-</em>',
'faq_lead' => 'The questions we hear most often from Belgrade clients before signing. If yours isn’t here, get in touch - we reply the same day.',
'faq' => [
    ['briefcase',      'How much does a website in Belgrade cost?',
                       'The price depends on the scope, the complexity of the functionality and whether the design is custom. That is why we don’t publish a “starting from” price list - on the Belgrade market it means nothing until it is clear what the site has to do. After a short conversation you receive a <strong>written quote with a fixed price, deadlines per phase and a list of everything the job includes</strong>, within 48 hours.'],
    ['clock',          'How long does it take to build a website?',
                       'A mid-sized brochure site is usually finished in <strong>8 to 12 days</strong>, while corporate sites, online stores and web applications can take longer, depending on the scope and the integrations. We split the timeline into phases with exact dates, so at any moment you know where things stand and what is waiting on you.'],
    ['star-fill',      'How is your website different from cheap template solutions?',
                       'A template is identical for you and for the several thousand other companies that bought it, it carries code you don’t need and that is why it loads slowly. We write <strong>the design and the code to fit your business</strong>: the site is lighter, faster, built around how your customers actually decide and - most important on the Belgrade market - it looks like nothing else out there.'],
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
    ['calendar-check', 'Content plan i objavljivanje', 'Mesečni plan tema i objava koji dobijate unapred na odobrenje. Znate šta izlazi, kog dana i zašto - bez improvizacije u poslednji čas.'],
    ['palette2',       'Dizajn vizuala',               'Grafike, priče i korice u bojama Vašeg brenda. Profil posle par nedelja izgleda kao celina, a ne kao skup nepovezanih objava.'],
    ['play-fill',      'Snimanje i montaža',           'Dolazimo kod Vas i snimamo u radnji, salonu ili na terenu. Montažu, tekst i muziku radimo mi.'],
    ['chat-dots',      'Community management',         'Odgovaramo na komentare i poruke u radno vreme, tonom koji smo prethodno usaglasili. Sve što traži Vašu odluku prosleđujemo odmah.'],
    ['cash-coin',      'Oglašavanje (Meta Ads)',       'Ciljane kampanje prema ljudima iz Pančeva i okoline - za posete radnji, poruke ili pozive, a ne za prazne lajkove.'],
    ['graph-up',       'Izveštaji i analitika',        'Svakog meseca dobijate brojeve koji nešto znače: doseg, nove pratioce, poruke i klikove, uz zaključak šta je dobro, a šta moramo da popravimo za sledeći mesec.'],
],

'proc_h2'   => 'Kako izgleda saradnja od prvog poziva <em>-</em>',
'proc_lead' => 'Četiri koraka, jasan mesečni ritam i jedna osoba sa kojom komunicirate. Prvi sastanak najčešće držimo uživo jer tako najbrže uhvatimo ton kojim Vaš brend govori.',
'proc' => [
    ['Analiza profila i publike',  'Pregledamo postojeće naloge, vidimo šta je do sada radilo, ko Vas prati i ko su Vam kupci. Istražimo i konkurenciju i njihov nastup na mrežama.'],
    ['Strategija i content plan',  'Biramo mreže na kojima Vaša publika zaista jeste, definišemo rubrike, ton i ritam objavljivanja. Dobijate pisani plan za prvi mesec i ponudu sa jasnim obimom.'],
    ['Produkcija i objavljivanje', 'Snimamo i dizajniramo sadržaj, pišemo tekstove i objavljujemo po kalendaru. Sve objave vidite pre izlaska i imate pravo na izmene.'],
    ['Oglašavanje i izveštaj',     'Pokrećemo kampanje prema dogovorenom budžetu, pratimo šta donosi upite, a na kraju meseca šaljemo izveštaj sa preporukom za sledeći korak.'],
],

'ind_h2'   => 'Za koga vodimo mreže u Pančevu <em>-</em>',
'ind_lead' => 'Radimo sa lokalnim poslovima kojima kupac dolazi iz okoline - onima koje ljudi prvo vide na Instagramu, pa tek onda uživo. Ovo su poslovi čije profile najčešće vodimo u Pančevu i okolini.',
'ind' => [
    'Restorani, kafići i dostava hrane',
    'Frizerski i kozmetički saloni',
    'Teretane i fitnes studiji',
    'Stomatološke ordinacije',
    'Prodavnice, butici i obućarske radnje',
    'Poslastičarnice i pekare',
    'Auto-servisi i auto-placevi',
    'Sale za proslave i event prostori',
    'Privatne škole, vrtići i kursevi',
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
    ['Community management',  'Odgovaranje na poruke i komentare umesto Vas. Zavisi od toga koliko upita profil dobija i u kom roku treba odgovoriti.'],
    ['Oglašavanje',           'Vođenje kampanja je naš rad. Budžet koji ide Meti plaćate direktno, sa svog naloga, pa u svakom trenutku vidite koliko je potrošeno.'],
],
'price_note' => 'Ne radimo „paket“ u koji se ne vidi šta ulazi. Posle kratkog razgovora dobijate pisanu ponudu sa tačnim brojem objava, priča i reels-a, jasnom mesečnom cenom i spiskom onoga što se plaća odvojeno. Ponudu šaljemo u roku od 48 sati, bez naknade i bez obaveze da nastavite dalje.',

'faq_h2'   => 'Česta pitanja o vođenju društvenih mreža u Pančevu <em>-</em>',
'faq_lead' => 'Pitanja koja nam klijenti iz Pančeva najčešće postavljaju pre početka saradnje.',
'faq' => [
    ['briefcase', 'Koliko košta vođenje društvenih mreža u Pančevu?',
                  'Cena zavisi od broja mreža, broja objava mesečno i toga da li snimamo sadržaj na terenu. Radimo <strong>mesečno, po jasno definisanom obimu</strong>: tačno se zna koliko objava, priča i reels-a ulazi u dogovor. Ponudu dobijate u roku od 48 sati, bez obaveze.'],
    ['calendar-check', 'Koliko objava mesečno je dovoljno?',
                  'Za lokalni biznis u Pančevu najčešće je dovoljno <strong>osam do dvanaest objava i redovne priče</strong> tokom nedelje. Bitnija je doslednost nego količina - profil koji objavljuje svake nedelje po planu nadmašuje onaj sa deset objava u jednom danu, pa tišinom mesec dana.'],
    ['play-fill', 'Da li Vi snimate sadržaj ili to moram ja?',
                  'Možemo oboje. Pošto smo iz Pančeva, <strong>dolazimo kod Vas i snimamo na licu mesta</strong> - u radnji, salonu ili na gradilištu. Ako Vam je lakše, snimate telefonom po našem kratkom uputstvu, a mi radimo montažu, tekst i objavu.'],
    ['chat-dots', 'Ko odgovara na poruke i komentare?',
                  'Mi, ako tako dogovorimo. Community management je deo usluge: <strong>odgovaramo na komentare i poruke u radno vreme</strong>, po tonu i informacijama koje smo prethodno usaglasili sa Vama. Sve što traži Vašu odluku prosleđujemo odmah.'],
    ['check2-circle', 'Da li mogu da vidim sadržaj pre objave?',
                  'Naravno. <strong>Mesečni plan sa temama i vizualima dobijate na odobrenje pre početka meseca</strong>, pa ništa ne izlazi bez Vaše saglasnosti. Izmene u toj fazi su uobičajene i ne naplaćuju se posebno.'],
    ['cash-coin', 'Da li je oglašavanje uračunato u cenu?',
                  'Rad na kampanjama jeste, ali <strong>budžet koji ide Meti plaćate direktno Vi</strong> - tako uvek vidite koliko je potrošeno i na šta. Preporučujemo iznos primeren lokalnom tržištu i pokažemo šta je za taj novac postignuto.'],
    ['clock',     'Da li moram da potpišem dugoročan ugovor?',
                  'Ne. Saradnja ide iz meseca u mesec i možete je prekinuti kad god želite, uz najavu do kraja tekućeg meseca. <strong>Nalozi, objavljeni materijali i pristupni podaci ostaju Vaši</strong> - ne držimo klijente ugovorom nego rezultatom.'],
    ['graph-up',  'Kako znam da li se isplati?',
                  'Svakog meseca dobijate izveštaj sa brojevima koji nešto znače: <strong>doseg, novi pratioci, poruke, klikovi ka sajtu i pozivi</strong>, uz kratak zaključak šta je radilo, a šta menjamo sledeći mesec. Bez „lajkova“ kao jedinog pokazatelja.'],
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
    'Restaurants, cafés and food delivery',
    'Hair and beauty salons',
    'Gyms and fitness studios',
    'Dental practices',
    'Shops, boutiques and shoe stores',
    'Patisseries and bakeries',
    'Car services and dealerships',
    'Function rooms and event venues',
    'Private schools, nurseries and courses',
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
'price_note' => 'We don’t sell a “package” you cannot see into. After a short conversation you receive a written quote with the exact number of posts, stories and reels, a clear monthly price and a list of what is paid separately. We send the quote within 48 hours, free of charge and with no obligation to go further.',

'faq_h2'   => 'Frequently asked questions about social media management in Pančevo <em>-</em>',
'faq_lead' => 'The questions clients from Pančevo ask us most often before we start.',
'faq' => [
    ['briefcase', 'How much does social media management in Pančevo cost?',
                  'The price depends on the number of channels, the number of posts per month and whether we shoot content on location. We work <strong>monthly, with a clearly defined scope</strong>: you know exactly how many posts, stories and reels are included. You receive the quote within 48 hours, with no obligation.'],
    ['calendar-check', 'How many posts a month are enough?',
                  'For a local business in Pančevo, <strong>eight to twelve posts plus regular stories</strong> during the week is usually enough. Consistency matters more than volume - a profile that posts every week to a plan beats one with ten posts in a single day followed by a month of silence.'],
    ['play-fill', 'Do you shoot the content, or do I have to?',
                  'Either works. Since we are based in Pančevo, <strong>we come to you and shoot on location</strong> - in your shop, salon or on site. If it’s easier, you film on your phone following our short brief, and we handle the editing, the caption and the posting.'],
    ['chat-dots', 'Who replies to messages and comments?',
                  'We do, if that’s what we agree. Community management is part of the service: <strong>we answer comments and messages during working hours</strong>, in the tone and with the information we agreed with you beforehand. Anything that needs your decision is forwarded immediately.'],
    ['check2-circle', 'Can I see the content before it is published?',
                  'Of course. <strong>The monthly plan with topics and visuals comes to you for approval before the month starts</strong>, so nothing goes out without your agreement. Changes at that stage are normal and are not charged separately.'],
    ['cash-coin', 'Is advertising spend included in the price?',
                  'The campaign work is; <strong>the budget that goes to Meta you pay directly</strong> - so you always see how much was spent and on what. We recommend an amount that fits the local market and show what it achieved.'],
    ['clock',     'Do I have to sign a long-term contract?',
                  'No. The collaboration runs month to month and you can end it whenever you like, with notice by the end of the current month. <strong>The accounts, the published material and the access details stay yours</strong> - we keep clients through results, not contracts.'],
    ['graph-up',  'How do I know it’s worth it?',
                  'Every month you receive a report with numbers that mean something: <strong>reach, new followers, messages, clicks to your website and calls</strong>, plus a short conclusion on what worked and what we change next month. No “likes” as the only metric.'],
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
    ['calendar-check', 'Content plan i objavljivanje', 'Mesečni kalendar sa temama, formatima i datumima, na odobrenje pre početka meseca. Ritam se drži i kada je sezona najgušća.'],
    ['palette2',       'Dizajn vizuala',               'Vizuelni sistem koji se prepozna u feedu i pre nego što se pročita ime brenda - grafike, korice, priče i šabloni za dalju upotrebu.'],
    ['play-fill',      'Produkcija reels-a',           'Snimanje i montaža kratke forme, na Vašoj lokaciji ili u dogovorenom terminu. Montaža, titlovi i izbor muzike su na nama.'],
    ['chat-dots',      'Community management',         'Poruke, komentari i upiti dobijaju odgovor u radnom vremenu, po unapred usaglašenim odgovorima na česta pitanja. Ono o čemu Vi treba da odlučite prosleđujemo bez čekanja.'],
    ['cash-coin',      'Meta i TikTok kampanje',       'Postavka publika, testiranje kreativa i optimizacija prema cilju - poruke, prodaja ili poseta lokalu, zavisno od toga šta Vam treba.'],
    ['graph-up',       'Mesečni izveštaji',            'Doseg, rast, interakcije i klikovi u poređenju sa prethodnim mesecom, uz kratak zaključak šta je dalo rezultat, a šta popravljamo u narednom mesecu.'],
],

'proc_h2'   => 'Kako izgleda saradnja od prvog poziva <em>-</em>',
'proc_lead' => 'Proces ima četiri koraka, mesečni ritam i jednu kontakt osobu. Uvodni sastanak držimo uživo u Beogradu kad god je moguće - to je najbrži način da razumemo brend i publiku kojoj se obraća.',
'proc' => [
    ['Analiza profila i publike',  'Prolazimo kroz naloge, statistiku i dosadašnji sadržaj. Mapiramo publiku i pregledamo kako nastupaju najjači konkurenti iz Vaše branše.'],
    ['Strategija i content plan',  'Postavljamo cilj, biramo dve do tri mreže koje se stvarno isplate i definišemo rubrike i ton. Dobijate plan za prvi mesec i ponudu sa preciznim obimom.'],
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
    'Event i wedding agencije',
    'Privatne škole i edukativni centri',
    'Kafići i specialty coffee',
    'Auto industrija i saloni',
    'IT i B2B brendovi',
],

'price_h2'   => 'Koliko košta vođenje društvenih mreža u Beogradu <em>-</em>',
'price_lead' => 'Naknada je mesečna i formira se prema obimu koji dogovorimo na početku. Ovih pet stavki određuje cenu paketa.',
'price' => [
    ['Broj mreža',            'Instagram sam za sebe, ili u kombinaciji sa Facebook-om, TikTok-om i LinkedIn-om. Za svaku mrežu sadržaj se posebno prilagođava.'],
    ['Obim sadržaja',         'Broj objava, priča i reels-a u toku meseca. Kratka forma traži najviše vremena po jednoj objavi.'],
    ['Produkcija',            'Snimanje na lokaciji, fotografija proizvoda i montaža. Kada materijal šaljete Vi, u skladu sa tim korigujemo cenu paketa.'],
    ['Community management',  'Obim poruka i komentara i koliko brzo na njih treba odgovoriti. Za profile sa velikim prilivom upita ovo je zaseban posao.'],
    ['Oglašavanje',           'Postavka i optimizacija kampanja su naš rad. Budžet koji ide Meti ili TikTok-u plaćate direktno, sa svog naloga.'],
],
'price_note' => 'U ponudi piše tačan broj objava, priča i reels-a, šta ulazi u produkciju i šta se plaća odvojeno - bez „paketa“ u koje se ne vidi. Ponudu dobijate u roku od 48 sati - ne naplaćujemo je i ne obavezuje Vas ni na šta.',

'faq_h2'   => 'Česta pitanja o vođenju društvenih mreža u Beogradu <em>-</em>',
'faq_lead' => 'Pitanja koja najčešće čujemo od beogradskih klijenata pre početka saradnje.',
'faq' => [
    ['briefcase', 'Koliko košta vođenje društvenih mreža u Beogradu?',
                  'Zavisi od broja mreža, obima sadržaja i toga da li uz to ide i produkcija (snimanje i montaža). Radimo <strong>mesečno, po tačno definisanom obimu</strong> - bez „paketa“ u koje se ne vidi šta ulazi. Ponudu dobijate u roku od 48 sati.'],
    ['calendar-check', 'Koliko traje dok se vide rezultati?',
                  'Prvi pomaci u dosegu i interakciji vide se obično <strong>posle šest do osam nedelja</strong> doslednog objavljivanja. Za merljiv rast upita i prodaje na beogradskom tržištu računajte na tri do šest meseci, pogotovo ako uz sadržaj ide i oglašavanje.'],
    ['play-fill', 'Da li radite i produkciju sadržaja?',
                  'Da - snimanje i montažu reels-a, fotografije proizvoda i grafičke vizuale. <strong>Dolazimo na lokaciju u Beogradu</strong> po dogovorenom terminu, ili radimo od materijala koji nam Vi pošaljete, uz naš kratak brief kako da se snimi.'],
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
    ['cash-coin',      'Meta and TikTok campaigns','Audience setup, creative testing and optimisation toward the goal - messages, sales or visits to your venue, depending on what you need.'],
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
    'Private schools and training centres',
    'Cafés and specialty coffee',
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
'price_note' => 'The quote states the exact number of posts, stories and reels, what production covers and what is paid separately - no “packages” you cannot see into. You receive it within 48 hours - we don’t charge for it and it commits you to nothing.',

'faq_h2'   => 'Frequently asked questions about social media management in Belgrade <em>-</em>',
'faq_lead' => 'The questions we hear most often from Belgrade clients before we start.',
'faq' => [
    ['briefcase', 'How much does social media management in Belgrade cost?',
                  'It depends on the number of channels, the volume of content and whether production (shooting and editing) is included. We work <strong>monthly, with a precisely defined scope</strong> - no “packages” you cannot see into. You receive the quote within 48 hours.'],
    ['calendar-check', 'How long before results show?',
                  'The first movement in reach and engagement is usually visible <strong>after six to eight weeks</strong> of consistent posting. For measurable growth in enquiries and sales on the Belgrade market, count on three to six months, especially if advertising runs alongside the content.'],
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

], /* end city */

];