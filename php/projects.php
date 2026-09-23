<?php
/**
 * VUG - portfolio: podaci o projektima.
 *
 * ==========================================================================
 * !!! DEMO SADRŽAJ !!!  Nazivi klijenata, tekstovi i brojevi su IZMIŠLJENI i
 * služe isključivo za dizajn/izgled portfolija. Nijedan podatak ovde ne
 * pripada stvarnom klijentu i nijedan rezultat nije proveren.
 *
 * Zato je $GLOBALS['VUG_PROJECTS_DEMO'] = true - dok je uključeno, portfolio
 * stranice se ne indeksiraju (noindex). Kada ubaciš prave projekte:
 *   1) zameni tekstove i brojeve stvarnim, proverljivim podacima,
 *   2) postavi 'url' na pravi live link (ili null ako ga nema),
 *   3) prebaci DEMO na false (pa stranice postaju index, follow),
 *   4) dodaj URL-ove u sitemap.xml.
 * ==========================================================================
 *
 * Struktura: jedan zapis = zajednički (jezik-neutralni) podaci + 'sr'/'en'
 * blokovi sa tekstom, isto kao u legal.php. Ključevi u 'sr' i 'en' MORAJU
 * biti identični.
 *
 * Vizuali se generišu proceduralno (php/project-art.php) i žive u
 * /img/projects/<slug>-cover.svg, -1.svg, -2.svg, -3.svg.
 *
 * DVA ŠABONA STRANICE (vug_project_template):
 *   - 'web'    -> cat 'web' | 'web-app'  (partials/project-web.php)
 *   - 'social' -> cat 'social'           (partials/project-social.php)
 *
 * Social projekti imaju i dodatna polja, jer je slučaj drugačiji od sajta:
 *   'social' => ['handle' => '@nalog', 'channels' => [[ikona, naziv, nalog], …]]
 *   'pillars' (po jeziku) => 3 rubrike [naziv, opis, [formati]] - voze i sekciju
 *              „Rubrike“ i vertikalne 9:16 vizuale (<slug>-r1..r3.svg)
 *   'rhythm'  (po jeziku) => [[dan/ritam, šta izlazi], …] - kalendar objavljivanja
 * Kod social projekata 'stack' sadrži SAMO alate (platforme idu u 'channels').
 *
 * VAŽNO za boje: 'a1' je glavni akcent (glow, ivice, ikonice), a 'a2' MORA
 * biti svetao ton iz palete (--mint #cffbf6, --cyan #5dd3f5 ili --soft #abbbe5)
 * jer se koristi kao pozadina bedževa/dugmadi sa tamnim tekstom (var(--deep)).
 * Ako 'a2' postane tamna boja, bedževi na karticama postaju nečitki.
 */

$GLOBALS['VUG_PROJECTS_DEMO'] = true;

if (!function_exists('vug_projects_raw')) {

/** Sirovi zapisi (baza + oba jezika). */
function vug_projects_raw(): array {
    return [

/* ══════════════════════════ WEB APLIKACIJE ══════════════════════════ */

'terminus-rezervacije' => [
    'cat' => 'web-app', 'a1' => '#3b82c4', 'a2' => '#cffbf6', 'year' => '2025',
    'seed' => 11, 'featured' => true, 'url' => null,
    'art' => ['cover' => 'booking', 'shots' => ['booking', 'app', 'mobile']],
    'stack' => ['PHP', 'MySQL', 'Alpine.js', 'Stripe', 'WebSocket'],
    'metrics' => [
        ['v' => 92, 'suf' => '%', 'sr' => 'rezervacija bez poziva',      'en' => 'bookings without a phone call'],
        ['v' => 40, 'suf' => 'h', 'sr' => 'mesečno manje administracije','en' => 'less admin work per month'],
        ['v' => 18, 'suf' => 's', 'sr' => 'prosečno do potvrde termina', 'en' => 'average time to confirmation'],
    ],
    'sr' => [
        'client' => 'Terminus Sports', 'title' => 'Terminus',
        'sector' => 'Sport i rekreacija',
        'tagline' => 'Sistem za online rezervaciju terena koji je zamenio sveske, pozive i Excel tabele.',
        'summary' => 'Platforma za sportske centre sa live pregledom zauzetosti, online plaćanjem i automatskim podsetnicima. Jedan ekran za korisnika, jedan za osoblje - bez duplih rezervacija.',
        'services' => ['Web aplikacija', 'UI/UX dizajn', 'Integracija plaćanja', 'Održavanje'],
        'duration' => '14 nedelja',
        'challenge' => 'Termini su se vodili telefonom i u papirnoj svesci. Vikendom je linija bila zauzeta, dupli upisi su bili česti, a nijedan podatak o zauzetosti terena nije postojao u digitalnom obliku.',
        'approach' => 'Napravili smo model dostupnosti po terenu, satnici i sezoni, pa nad njim interfejs koji u realnom vremenu zaključava termin dok se plaćanje ne završi. Osoblje dobija poseban panel sa dnevnim rasporedom, blokadama i ručnim upisom.',
        'result' => 'Rezervacija traje manje od pola minuta i ide bez ljudske intervencije. Uprava prvi put ima tačan podatak o iskorišćenosti terena po danu, satu i tipu korisnika.',
        'highlights' => [
            ['calendar-check', 'Live kalendar', 'Zauzetost se osvežava kod svih korisnika istog trenutka, bez ručnog refresh-a.'],
            ['cash-coin', 'Online plaćanje', 'Kartično plaćanje i avans, sa automatskim računom na email.'],
            ['arrow-repeat', 'Ponavljajući termini', 'Stalni zakupci zakazuju ceo mesec u jednom koraku.'],
            ['chat-dots', 'Automatski podsetnici', 'SMS i email podsetnik 2 sata pre termina - manje nedolazaka.'],
            ['bar-chart', 'Panel za upravu', 'Iskorišćenost terena, prihod po satu i najtraženiji termini.'],
            ['person', 'Uloge i prava', 'Recepcija, trener i administrator vide samo ono što im treba.'],
        ],
        'shots' => ['Javni kalendar sa live zauzetošću terena', 'Administratorski panel - dnevni raspored i blokade', 'Mobilni tok rezervacije u tri koraka'],
    ],
    'en' => [
        'client' => 'Terminus Sports', 'title' => 'Terminus',
        'sector' => 'Sports & recreation',
        'tagline' => 'An online court booking system that replaced notebooks, phone calls and spreadsheets.',
        'summary' => 'A platform for sports centres with live availability, online payments and automatic reminders. One screen for the customer, one for the staff - and no double bookings.',
        'services' => ['Web application', 'UI/UX design', 'Payment integration', 'Maintenance'],
        'duration' => '14 weeks',
        'challenge' => 'Bookings were handled by phone and written in a paper notebook. On weekends the line was always busy, double entries were common, and no court occupancy data existed in digital form.',
        'approach' => 'We modelled availability per court, time slot and season, then built an interface that locks a slot in real time until payment completes. Staff get a dedicated panel with the daily schedule, blocks and manual entries.',
        'result' => 'A booking now takes under half a minute and needs no human involvement. For the first time management has exact occupancy data by day, hour and customer type.',
        'highlights' => [
            ['calendar-check', 'Live calendar', 'Availability updates for every visitor at the same moment, with no manual refresh.'],
            ['cash-coin', 'Online payments', 'Card payments and deposits, with an automatic receipt by email.'],
            ['arrow-repeat', 'Recurring slots', 'Regular members book an entire month in a single step.'],
            ['chat-dots', 'Automatic reminders', 'SMS and email reminder two hours before the slot - fewer no-shows.'],
            ['bar-chart', 'Management panel', 'Court utilisation, revenue per hour and the most requested slots.'],
            ['person', 'Roles & permissions', 'Reception, coaches and admins each see only what they need.'],
        ],
        'shots' => ['Public calendar with live court availability', 'Admin panel - daily schedule and blocks', 'Mobile booking flow in three steps'],
    ],
],

'lexora-pravni-sistem' => [
    'cat' => 'web-app', 'a1' => '#5d54b8', 'a2' => '#5dd3f5', 'year' => '2025',
    'seed' => 23, 'featured' => true, 'url' => null,
    'art' => ['cover' => 'app', 'shots' => ['app', 'analytics', 'mobile']],
    'stack' => ['Laravel', 'PostgreSQL', 'Vue', 'Redis', 'S3'],
    'metrics' => [
        ['v' => 6,   'suf' => 'x',  'sr' => 'brže pronalaženje predmeta', 'en' => 'faster case lookup'],
        ['v' => 100, 'suf' => '%',  'sr' => 'ročišta sa podsetnikom',     'en' => 'hearings with a reminder'],
        ['v' => 3,   'suf' => 'min','sr' => 'do kompletnog izveštaja',    'en' => 'to a complete report'],
    ],
    'sr' => [
        'client' => 'Lexora Legal', 'title' => 'Lexora',
        'sector' => 'Pravne usluge',
        'tagline' => 'Interna aplikacija za vođenje predmeta, ročišta i rokova advokatske kancelarije.',
        'summary' => 'Predmeti, klijenti, dokumenti i rokovi na jednom mestu, sa kalendarom ročišta i evidencijom naplativih sati. Sve što je kancelarija ranije držala u fasciklama i glavi.',
        'services' => ['Web aplikacija', 'Arhitektura podataka', 'Migracija arhive', 'Obuka tima'],
        'duration' => '20 nedelja',
        'challenge' => 'Kancelarija je rasla brže od svog sistema: predmeti u fasciklama, rokovi u ličnim kalendarima, a status pojedinog spora znao je samo advokat koji ga vodi. Svaki izveštaj klijentu radio se ručno.',
        'approach' => 'Krenuli smo od modela predmeta - stranke, instance, radnje, rokovi i dokumenti - i pustili da interfejs prati stvarni tok rada, a ne obrnuto. Rokovi se računaju automatski, a svaka radnja upisuje se u istoriju predmeta.',
        'result' => 'Ceo tim vidi isti, uvek svež status predmeta. Rokovi se ne propuštaju jer sistem sam pravi zadatke, a izveštaj za klijenta je pitanje jednog klika.',
        'highlights' => [
            ['briefcase', 'Kartica predmeta', 'Stranke, instance, radnje i dokumenti u jednoj hronologiji.'],
            ['clock', 'Automatski rokovi', 'Zakonski rokovi se izračunavaju i pretvaraju u zadatke sa podsetnikom.'],
            ['calendar-check', 'Kalendar ročišta', 'Pregled po advokatu, sudu i danu, sa sinhronizacijom na telefon.'],
            ['search', 'Pretraga arhive', 'Pun tekst kroz predmete i priložene dokumente.'],
            ['cash-coin', 'Naplativi sati', 'Evidencija rada po predmetu i automatska priprema obračuna.'],
            ['check2-circle', 'Kontrola pristupa', 'Precizna prava po ulozi - poverljivi predmeti ostaju poverljivi.'],
        ],
        'shots' => ['Radna tabla sa rokovima i predmetima u toku', 'Analitika opterećenja tima i naplativih sati', 'Mobilni pregled ročišta za taj dan'],
    ],
    'en' => [
        'client' => 'Lexora Legal', 'title' => 'Lexora',
        'sector' => 'Legal services',
        'tagline' => 'An internal app for managing cases, hearings and deadlines in a law firm.',
        'summary' => 'Cases, clients, documents and deadlines in one place, with a hearing calendar and billable-hour tracking. Everything the firm used to keep in folders and in people\'s heads.',
        'services' => ['Web application', 'Data architecture', 'Archive migration', 'Team training'],
        'duration' => '20 weeks',
        'challenge' => 'The firm outgrew its own system: cases in folders, deadlines in personal calendars, and the status of a dispute known only to the lawyer running it. Every client report was written by hand.',
        'approach' => 'We started from the case model - parties, instances, actions, deadlines and documents - and let the interface follow the real workflow instead of the other way around. Deadlines are calculated automatically and every action is written into the case history.',
        'result' => 'The whole team sees the same, always current case status. Deadlines are not missed because the system creates the tasks itself, and a client report is one click away.',
        'highlights' => [
            ['briefcase', 'Case record', 'Parties, instances, actions and documents in a single timeline.'],
            ['clock', 'Automatic deadlines', 'Statutory deadlines are calculated and turned into tasks with reminders.'],
            ['calendar-check', 'Hearing calendar', 'By lawyer, court and day, synced to the phone.'],
            ['search', 'Archive search', 'Full text across cases and attached documents.'],
            ['cash-coin', 'Billable hours', 'Time logged per case and billing prepared automatically.'],
            ['check2-circle', 'Access control', 'Granular role permissions - confidential cases stay confidential.'],
        ],
        'shots' => ['Dashboard with deadlines and active cases', 'Analytics on team workload and billable hours', 'Mobile view of the day\'s hearings'],
    ],
],

'flotila-dostava' => [
    'cat' => 'web-app', 'a1' => '#4f4698', 'a2' => '#cffbf6', 'year' => '2024',
    'seed' => 37, 'featured' => false, 'url' => null,
    'art' => ['cover' => 'mobile', 'shots' => ['mobile', 'app', 'analytics']],
    'stack' => ['Node.js', 'React Native', 'MongoDB', 'Mapbox', 'Push API'],
    'metrics' => [
        ['v' => 27, 'suf' => '%', 'sr' => 'kraće vreme dostave',       'en' => 'shorter delivery time'],
        ['v' => 3,  'suf' => 'x', 'sr' => 'manje poziva „gde mi je?“', 'en' => 'fewer "where is it?" calls'],
        ['v' => 99, 'suf' => '%', 'sr' => 'tačno dodeljenih porudžbina','en' => 'orders assigned correctly'],
    ],
    'sr' => [
        'client' => 'Flotila', 'title' => 'Flotila',
        'sector' => 'Dostava hrane',
        'tagline' => 'Aplikacija za dispečera i kurira koja svaku dostavu prati u realnom vremenu.',
        'summary' => 'Web panel za dispečera i mobilna aplikacija za kurire, povezani live mapom. Porudžbina se dodeljuje u par sekundi, a kupac dobija link za praćenje.',
        'services' => ['Web aplikacija', 'Mobilna aplikacija', 'Integracija mapa', 'Podrška'],
        'duration' => '16 nedelja',
        'challenge' => 'Sa rastom broja porudžbina dispečer je izgubio pregled: ko je gde, koja tura je preuzeta i zašto neka dostava kasni. Kupci su zvali restoran, restoran kurira, kurir nikoga.',
        'approach' => 'Postavili smo jednu tablu na kojoj su porudžbine, kuriri i vreme u jednom kadru. Kurirska aplikacija radi i u tunelu - upisuje offline i sinhronizuje se kad signal vrati, pa se nijedan status ne izgubi.',
        'result' => 'Dispečer dodeljuje ture prevlačenjem, kupac vidi kurira na mapi, a menadžment ima istoriju svake dostave sa vremenima po koraku.',
        'highlights' => [
            ['geo-alt', 'Live mapa', 'Pozicija kurira i procenjeno vreme dolaska, osvežavano u sekundama.'],
            ['diagram-3', 'Pametna dodela', 'Predlog najbližeg slobodnog kurira po zoni i trenutnom opterećenju.'],
            ['phone', 'Aplikacija za kurira', 'Radi offline, sa jasnim koracima: preuzeto, u putu, dostavljeno.'],
            ['chat-dots', 'Link za praćenje', 'Kupac prati porudžbinu bez instalacije aplikacije.'],
            ['bar-chart', 'Izveštaji', 'Vreme po koraku, kašnjenja i učinak po smeni.'],
            ['lightning-charge-fill', 'Brzi unos', 'Telefonska porudžbina se upisuje u manje od 30 sekundi.'],
        ],
        'shots' => ['Kurirska aplikacija - tura i status dostave', 'Dispečerska tabla sa live mapom', 'Izveštaj o vremenima dostave po smeni'],
    ],
    'en' => [
        'client' => 'Flotila', 'title' => 'Flotila',
        'sector' => 'Food delivery',
        'tagline' => 'A dispatcher and courier app that tracks every delivery in real time.',
        'summary' => 'A web panel for dispatchers and a mobile app for couriers, tied together by a live map. Orders are assigned in seconds and the customer gets a tracking link.',
        'services' => ['Web application', 'Mobile application', 'Maps integration', 'Support'],
        'duration' => '16 weeks',
        'challenge' => 'As order volume grew the dispatcher lost the overview: who was where, which run had been picked up and why a delivery was late. Customers called the restaurant, the restaurant called the courier, the courier called no one.',
        'approach' => 'We put orders, couriers and time into a single board. The courier app also works in a tunnel - it writes offline and syncs once signal returns, so no status is ever lost.',
        'result' => 'Dispatchers assign runs by dragging, customers watch the courier on a map, and management has a history of every delivery with timings per step.',
        'highlights' => [
            ['geo-alt', 'Live map', 'Courier position and estimated arrival, refreshed within seconds.'],
            ['diagram-3', 'Smart assignment', 'Suggests the nearest free courier by zone and current load.'],
            ['phone', 'Courier app', 'Works offline, with clear steps: picked up, en route, delivered.'],
            ['chat-dots', 'Tracking link', 'Customers follow the order without installing anything.'],
            ['bar-chart', 'Reports', 'Time per step, delays and performance by shift.'],
            ['lightning-charge-fill', 'Fast entry', 'A phone order is entered in under 30 seconds.'],
        ],
        'shots' => ['Courier app - run and delivery status', 'Dispatcher board with live map', 'Delivery timing report per shift'],
    ],
],

'kalibra-servis' => [
    'cat' => 'web-app', 'a1' => '#3b82c4', 'a2' => '#5dd3f5', 'year' => '2024',
    'seed' => 53, 'featured' => false, 'url' => null,
    'art' => ['cover' => 'analytics', 'shots' => ['app', 'booking', 'analytics']],
    'stack' => ['Symfony', 'MariaDB', 'htmx', 'Docker', 'REST API'],
    'metrics' => [
        ['v' => 34, 'suf' => '%', 'sr' => 'više servisa mesečno',       'en' => 'more jobs per month'],
        ['v' => 5,  'suf' => 'h', 'sr' => 'dnevno ušteđeno na papiru',  'en' => 'saved on paperwork daily'],
        ['v' => 0,  'suf' => '',  'sr' => 'izgubljenih radnih naloga',  'en' => 'lost work orders'],
    ],
    'sr' => [
        'client' => 'Kalibra Service', 'title' => 'Kalibra',
        'sector' => 'Tehnički servis',
        'tagline' => 'Platforma za radne naloge, delove i garancije u servisnoj mreži.',
        'summary' => 'Od prijema uređaja do izdavanja garantnog lista - svaki korak servisa je u sistemu, sa stanjem delova i automatskim obaveštenjem klijentu.',
        'services' => ['Web aplikacija', 'Integracija magacina', 'Automatizacija', 'Održavanje'],
        'duration' => '18 nedelja',
        'challenge' => 'Radni nalozi su bili blokovi papira: nečitki, izgubljeni ili zaboravljeni u fioci. Stanje delova znao je samo magacioner, a klijenti su zvali da pitaju da li je uređaj gotov.',
        'approach' => 'Digitalizovali smo nalog i vezali ga za magacin, pa se ugrađen deo istog trenutka oduzima sa stanja. Svaka promena statusa šalje obaveštenje klijentu, a garancija se generiše iz podataka naloga.',
        'result' => 'Serviser radi sa tableta, magacin ima tačno stanje, a klijent zna u kojoj je fazi njegov uređaj bez da nekoga pozove.',
        'highlights' => [
            ['tools', 'Digitalni radni nalog', 'Fotografije, dijagnoza, ugrađeni delovi i potpis klijenta.'],
            ['grid', 'Stanje delova', 'Automatsko oduzimanje sa lagera i alarm za minimalne količine.'],
            ['check2-circle', 'Garancije', 'Garantni list se generiše iz naloga, bez ponovnog prepisivanja.'],
            ['chat-dots', 'Obaveštenja klijentu', 'Email i SMS na svaku promenu statusa servisa.'],
            ['bar-chart', 'Analitika', 'Prosečno vreme popravke, najčešće greške i najskuplji delovi.'],
            ['calendar-check', 'Planiranje', 'Raspored servisera po danu i lokaciji, bez preklapanja.'],
        ],
        'shots' => ['Radni nalog sa dijagnozom i ugrađenim delovima', 'Raspored servisera po danu', 'Analitika servisa i potrošnje delova'],
    ],
    'en' => [
        'client' => 'Kalibra Service', 'title' => 'Kalibra',
        'sector' => 'Technical service',
        'tagline' => 'A platform for work orders, parts and warranties across a service network.',
        'summary' => 'From intake to warranty certificate - every step of a repair lives in the system, with parts stock and automatic customer notifications.',
        'services' => ['Web application', 'Warehouse integration', 'Automation', 'Maintenance'],
        'duration' => '18 weeks',
        'challenge' => 'Work orders were pads of paper: illegible, lost or forgotten in a drawer. Only the warehouse keeper knew the parts stock, and customers kept calling to ask whether their device was ready.',
        'approach' => 'We digitised the work order and tied it to the warehouse, so a fitted part is deducted from stock immediately. Every status change notifies the customer, and the warranty is generated from the order data.',
        'result' => 'Technicians work from a tablet, the warehouse has accurate stock, and customers know the stage of their repair without calling anyone.',
        'highlights' => [
            ['tools', 'Digital work order', 'Photos, diagnosis, fitted parts and the customer signature.'],
            ['grid', 'Parts stock', 'Automatic deduction from inventory and low-stock alerts.'],
            ['check2-circle', 'Warranties', 'The certificate is generated from the order, with nothing retyped.'],
            ['chat-dots', 'Customer notifications', 'Email and SMS on every change of repair status.'],
            ['bar-chart', 'Analytics', 'Average repair time, most common faults and costliest parts.'],
            ['calendar-check', 'Scheduling', 'Technician planning by day and location, with no overlaps.'],
        ],
        'shots' => ['Work order with diagnosis and fitted parts', 'Technician schedule by day', 'Service and parts consumption analytics'],
    ],
],

/* ══════════════════════════ WEB SAJTOVI ══════════════════════════ */

'vinea-estate' => [
    'cat' => 'web', 'a1' => '#5d54b8', 'a2' => '#cffbf6', 'year' => '2025',
    'seed' => 71, 'featured' => true, 'url' => null,
    'art' => ['cover' => 'shop', 'shots' => ['web', 'shop', 'mobile']],
    'stack' => ['WooCommerce', 'PHP', 'GSAP', 'Cloudflare', 'Schema.org'],
    'metrics' => [
        ['v' => 68, 'suf' => '%', 'sr' => 'više online prodaje',   'en' => 'more online sales'],
        ['v' => 96, 'suf' => '',  'sr' => 'PageSpeed rezultat',    'en' => 'PageSpeed score'],
        ['v' => 42, 'suf' => '%', 'sr' => 'veća prosečna korpa',   'en' => 'larger average basket'],
    ],
    'sr' => [
        'client' => 'Vinea Estate', 'title' => 'Vinea Estate',
        'sector' => 'Vinarija',
        'tagline' => 'Prezentacioni sajt i web prodavnica vinarije, sa pričom koja se čita kao etiketa.',
        'summary' => 'Sajt koji vodi posetioca kroz vinograd, godišta i degustacije, pa ga bez prekida prebacuje u kupovinu. Katalog, klub vina i rezervacija obilaska na jednom mestu.',
        'services' => ['Web sajt', 'E-commerce', 'Art direkcija', 'SEO'],
        'duration' => '10 nedelja',
        'challenge' => 'Vinarija je imala izuzetan proizvod i sajt star sedam godina koji to nije pokazivao. Prodaja je išla isključivo preko telefona, a pretraga za sortama i godištima nije postojala.',
        'approach' => 'Krenuli smo od fotografije i tipografije: veliki kadrovi, mirni prelazi i tekst koji prati ritam degustacije. Katalog smo strukturirali po sorti, godištu i uz šta se pije, pa je pretraga postala deo priče, a ne forma.',
        'result' => 'Posetilac stiže zbog priče, a ostaje zbog korpe. Vinarija prodaje online svakog dana i zna koje godište traži koja publika.',
        'highlights' => [
            ['cart', 'Web prodavnica', 'Katalog po sorti i godištu, sa paketima i poklon setovima.'],
            ['lightning-charge-fill', 'Brzina', 'Optimizovane slike i kritični CSS - sajt se otvara odmah.'],
            ['calendar-check', 'Rezervacija degustacije', 'Obilazak vinograda se zakazuje direktno sa sajta.'],
            ['search', 'SEO struktura', 'Strane po sortama i regionu, sa strukturiranim podacima.'],
            ['star-fill', 'Klub vina', 'Pretplata na mesečni paket sa članskim cenama.'],
            ['palette2', 'Vizuelni jezik', 'Tipografija i paleta izvedene iz same etikete.'],
        ],
        'shots' => ['Naslovna sa pričom vinarije', 'Katalog vina i stranica proizvoda', 'Mobilni tok kupovine'],
    ],
    'en' => [
        'client' => 'Vinea Estate', 'title' => 'Vinea Estate',
        'sector' => 'Winery',
        'tagline' => 'A winery site and online shop with a story that reads like the label.',
        'summary' => 'A site that walks visitors through the vineyard, vintages and tastings, then moves them into buying without a break. Catalogue, wine club and tour booking in one place.',
        'services' => ['Website', 'E-commerce', 'Art direction', 'SEO'],
        'duration' => '10 weeks',
        'challenge' => 'The winery had an exceptional product and a seven-year-old site that did not show it. Sales happened only over the phone, and there was no way to browse by variety or vintage.',
        'approach' => 'We started from photography and type: large frames, calm transitions and copy that follows the rhythm of a tasting. The catalogue is structured by variety, vintage and pairing, so browsing became part of the story rather than a form.',
        'result' => 'Visitors arrive for the story and stay for the basket. The winery sells online every day and knows which vintage which audience is looking for.',
        'highlights' => [
            ['cart', 'Online shop', 'Catalogue by variety and vintage, with bundles and gift sets.'],
            ['lightning-charge-fill', 'Speed', 'Optimised images and critical CSS - the site opens instantly.'],
            ['calendar-check', 'Tasting booking', 'Vineyard tours are booked straight from the site.'],
            ['search', 'SEO structure', 'Pages per variety and region, with structured data.'],
            ['star-fill', 'Wine club', 'Subscription to a monthly case at member pricing.'],
            ['palette2', 'Visual language', 'Type and palette derived from the label itself.'],
        ],
        'shots' => ['Home page with the winery story', 'Wine catalogue and product page', 'Mobile checkout flow'],
    ],
],

'nordis-arhitektura' => [
    'cat' => 'web', 'a1' => '#5dd3f5', 'a2' => '#abbbe5', 'year' => '2025',
    'seed' => 89, 'featured' => true, 'url' => null,
    'art' => ['cover' => 'web', 'shots' => ['web', 'brand', 'mobile']],
    'stack' => ['PHP', 'Vanilla JS', 'GSAP', 'WebP/AVIF', 'CDN'],
    'metrics' => [
        ['v' => 3,  'suf' => 'x', 'sr' => 'duže vreme na sajtu',      'en' => 'longer time on site'],
        ['v' => 12, 'suf' => '',  'sr' => 'upita mesečno iz forme',   'en' => 'enquiries per month via form'],
        ['v' => 1,  'suf' => 's', 'sr' => 'do prvog iscrtavanja',     'en' => 'to first render'],
    ],
    'sr' => [
        'client' => 'Nordis Studio', 'title' => 'Nordis Studio',
        'sector' => 'Arhitektura',
        'tagline' => 'Portfolio arhitektonskog biroa u kome projekti dišu - bez šuma oko njih.',
        'summary' => 'Minimalan, tipografski vođen sajt gde je svaka stranica projekta mala izložba: crteži, faze i finalne fotografije u ritmu skrolovanja.',
        'services' => ['Web sajt', 'Art direkcija', 'Copywriting', 'Optimizacija slika'],
        'duration' => '8 nedelja',
        'challenge' => 'Biro je imao izuzetne projekte i nijedno mesto da ih pokaže kako treba. Portfolio je živeo u PDF-ovima od 40 MB koji su se slali mejlom.',
        'approach' => 'Napravili smo mrežu koja se povinuje slici, ne obrnuto: velike, tiho animirane sekvence, tekst sveden na neophodno i navigacija koja se ne vidi dok ne zatreba. Sve slike idu kroz AVIF/WebP pipeline, pa velike fotografije ne koštaju brzinu.',
        'result' => 'Investitori prolaze kroz cele projekte, a ne kroz jednu naslovnu sliku. Prvi upiti kroz formu počeli su iste nedelje po lansiranju.',
        'highlights' => [
            ['grid', 'Projekti kao izložbe', 'Crtež, faza izgradnje i finalni kadar u jednoj priči.'],
            ['lightning-charge-fill', 'Lake velike slike', 'AVIF/WebP i lazy-load - 4K fotografije bez čekanja.'],
            ['palette2', 'Tipografska mreža', 'Sistem od četiri veličine teksta, dosledno kroz ceo sajt.'],
            ['arrow-repeat', 'Lako dodavanje', 'Novi projekat se objavljuje bez programera.'],
            ['search', 'Vidljivost', 'Čiste rute po projektu i strukturirani podaci.'],
            ['person', 'Pristupačnost', 'Kontrast, fokus i tastatura provereni po WCAG smernicama.'],
        ],
        'shots' => ['Naslovna sa mrežom projekata', 'Vizuelni identitet i tipografski sistem', 'Mobilni pregled stranice projekta'],
    ],
    'en' => [
        'client' => 'Nordis Studio', 'title' => 'Nordis Studio',
        'sector' => 'Architecture',
        'tagline' => 'An architecture studio portfolio where the projects breathe - with no noise around them.',
        'summary' => 'A minimal, typography-led site where each project page is a small exhibition: drawings, phases and final photography paced by the scroll.',
        'services' => ['Website', 'Art direction', 'Copywriting', 'Image optimisation'],
        'duration' => '8 weeks',
        'challenge' => 'The studio had outstanding projects and nowhere to show them properly. The portfolio lived in 40 MB PDFs sent by email.',
        'approach' => 'We built a grid that yields to the image rather than the other way around: large, quietly animated sequences, copy reduced to the essential, and navigation that stays out of sight until needed. Every image runs through an AVIF/WebP pipeline, so large photography costs no speed.',
        'result' => 'Clients now go through entire projects instead of a single cover shot. The first form enquiries arrived in the launch week.',
        'highlights' => [
            ['grid', 'Projects as exhibitions', 'Drawing, construction phase and final frame in one story.'],
            ['lightning-charge-fill', 'Light heavy images', 'AVIF/WebP and lazy loading - 4K photos with no wait.'],
            ['palette2', 'Typographic grid', 'A system of four text sizes, applied consistently throughout.'],
            ['arrow-repeat', 'Easy publishing', 'A new project goes live without a developer.'],
            ['search', 'Discoverability', 'Clean routes per project and structured data.'],
            ['person', 'Accessibility', 'Contrast, focus and keyboard paths checked against WCAG.'],
        ],
        'shots' => ['Home page with the project grid', 'Visual identity and type system', 'Mobile view of a project page'],
    ],
],

'hedon-restoran' => [
    'cat' => 'web', 'a1' => '#3b82c4', 'a2' => '#abbbe5', 'year' => '2024',
    'seed' => 101, 'featured' => false, 'url' => null,
    'art' => ['cover' => 'web', 'shots' => ['web', 'mobile', 'brand']],
    'stack' => ['PHP', 'MySQL', 'Alpine.js', 'Google Maps', 'Local SEO'],
    'metrics' => [
        ['v' => 58, 'suf' => '%', 'sr' => 'rezervacija preko sajta',      'en' => 'reservations via the site'],
        ['v' => 2,  'suf' => 'x', 'sr' => 'više pretraga brenda',         'en' => 'more brand searches'],
        ['v' => 15, 'suf' => '%', 'sr' => 'manje otkazanih rezervacija',  'en' => 'fewer cancellations'],
    ],
    'sr' => [
        'client' => 'Hedon', 'title' => 'Hedon',
        'sector' => 'Restoran',
        'tagline' => 'Sajt restorana koji rezervaciju stola rešava u tri klika, i menije drži uvek svežim.',
        'summary' => 'Atmosfera, meni i rezervacija - bez PDF-ova i bez pozivanja. Kuhinja menja meni sama, a Google odmah vidi izmenu.',
        'services' => ['Web sajt', 'Sistem rezervacija', 'Lokalni SEO', 'Foto direkcija'],
        'duration' => '7 nedelja',
        'challenge' => 'Meni je bio PDF koji se otvarao na pola telefona, rezervacije su išle preko Instagram poruka, a restoran se u pretrazi nije video ni po svom imenu.',
        'approach' => 'Meni je postao pravi sadržaj sajta - pretraživ, sa alergenima i sezonskim izmenama koje kuhinja unosi sama. Rezervacija ide bez naloga, sa potvrdom na email i pravilima koja štite od praznih stolova.',
        'result' => 'Više od polovine rezervacija dolazi sa sajta. Osoblje ne prepisuje termine iz poruka i restoran se pojavljuje u lokalnoj pretrazi sa punim podacima.',
        'highlights' => [
            ['calendar-check', 'Rezervacija stola', 'Tri klika, bez naloga, sa potvrdom i podsetnikom.'],
            ['tag', 'Živi meni', 'Sezonske izmene, alergeni i cene bez programera.'],
            ['geo-alt', 'Lokalni SEO', 'Google Business, mape i strukturirani podaci restorana.'],
            ['phone', 'Mobilno prvo', 'Devet od deset gostiju otvara sajt sa telefona.'],
            ['star-fill', 'Recenzije', 'Ocene gostiju povučene direktno sa Google profila.'],
            ['palette2', 'Atmosfera', 'Foto direkcija i paleta izvedene iz samog prostora.'],
        ],
        'shots' => ['Naslovna sa atmosferom prostora', 'Mobilni meni i tok rezervacije', 'Vizuelni identitet i štampani meni'],
    ],
    'en' => [
        'client' => 'Hedon', 'title' => 'Hedon',
        'sector' => 'Restaurant',
        'tagline' => 'A restaurant site that books a table in three clicks and keeps the menu always current.',
        'summary' => 'Atmosphere, menu and reservations - no PDFs and no phone calls. The kitchen updates the menu itself and Google sees the change immediately.',
        'services' => ['Website', 'Reservation system', 'Local SEO', 'Photo direction'],
        'duration' => '7 weeks',
        'challenge' => 'The menu was a PDF that opened at half the phone width, reservations came through Instagram messages, and the restaurant did not show up in search even for its own name.',
        'approach' => 'The menu became real site content - searchable, with allergens and seasonal changes the kitchen enters itself. Booking works without an account, with email confirmation and rules that protect against empty tables.',
        'result' => 'More than half of all reservations now come from the site. Staff no longer copy bookings out of messages, and the restaurant appears in local search with complete data.',
        'highlights' => [
            ['calendar-check', 'Table booking', 'Three clicks, no account, with confirmation and a reminder.'],
            ['tag', 'Living menu', 'Seasonal changes, allergens and prices without a developer.'],
            ['geo-alt', 'Local SEO', 'Google Business, maps and restaurant structured data.'],
            ['phone', 'Mobile first', 'Nine in ten guests open the site on a phone.'],
            ['star-fill', 'Reviews', 'Guest ratings pulled straight from the Google profile.'],
            ['palette2', 'Atmosphere', 'Photo direction and palette derived from the room itself.'],
        ],
        'shots' => ['Home page with the room\'s atmosphere', 'Mobile menu and booking flow', 'Visual identity and printed menu'],
    ],
],

'aurelia-advokati' => [
    'cat' => 'web', 'a1' => '#4f4698', 'a2' => '#5dd3f5', 'year' => '2024',
    'seed' => 127, 'featured' => false, 'url' => null,
    'art' => ['cover' => 'web', 'shots' => ['web', 'brand', 'app']],
    'stack' => ['PHP', 'MySQL', 'Schema.org', 'reCAPTCHA', 'Multilingual'],
    'metrics' => [
        ['v' => 4,  'suf' => 'x', 'sr' => 'više organskih poseta',   'en' => 'more organic visits'],
        ['v' => 9,  'suf' => '',  'sr' => 'pravnih oblasti na sajtu', 'en' => 'practice areas covered'],
        ['v' => 2,  'suf' => '',  'sr' => 'jezika, jedan sistem',     'en' => 'languages, one system'],
    ],
    'sr' => [
        'client' => 'Aurelia Legal', 'title' => 'Aurelia',
        'sector' => 'Advokatska kancelarija',
        'tagline' => 'Autoritativan, dvojezičan sajt kancelarije - klasična forma u savremenom kodu.',
        'summary' => 'Sajt koji poverenje gradi strukturom: jasne pravne oblasti, biografije advokata i tekstovi koji odgovaraju na pitanja klijenta pre prvog poziva.',
        'services' => ['Web sajt', 'Dvojezična struktura', 'SEO', 'Copywriting'],
        'duration' => '9 nedelja',
        'challenge' => 'Kancelarija je želela ozbiljan, gotovo klasičan ton - bez da sajt izgleda kao da je napravljen 2009. Uz to, polovina klijenata dolazi iz inostranstva, pa je engleska verzija morala da bude ravnopravna.',
        'approach' => 'Uzeli smo mirnu, simetričnu mrežu i tipografiju sa motivima klasične arhitekture, pa je spojili sa savremenim rasporedom i brzinom. Sadržaj je organizovan po pravnim oblastima, jer tako klijent i traži.',
        'result' => 'Organski dolasci su porasli kroz strane pravnih oblasti, a upiti su konkretniji jer klijent unapred zna čime se kancelarija bavi.',
        'highlights' => [
            ['briefcase', 'Pravne oblasti', 'Devet zasebnih strana pisanih jezikom klijenta, ne zakona.'],
            ['person', 'Biografije tima', 'Reference, jezici i specijalizacije svakog advokata.'],
            ['search', 'SEO temelj', 'Struktura, meta podaci i schema.org za pravne usluge.'],
            ['grid', 'Dvojezičnost', 'Srpski i engleski sa hreflang parovima, bez duplikata.'],
            ['check2-circle', 'Zaštita forme', 'Honeypot i reCAPTCHA - nijedan spam upit ne stiže do tima.'],
            ['palette2', 'Vizuelni ton', 'Klasični motivi u savremenoj, čitkoj formi.'],
        ],
        'shots' => ['Naslovna sa pravnim oblastima', 'Vizuelni identitet i pisani materijali', 'Interna evidencija upita'],
    ],
    'en' => [
        'client' => 'Aurelia Legal', 'title' => 'Aurelia',
        'sector' => 'Law firm',
        'tagline' => 'An authoritative bilingual firm website - classical form in modern code.',
        'summary' => 'A site that builds trust through structure: clear practice areas, lawyer profiles and copy that answers client questions before the first call.',
        'services' => ['Website', 'Bilingual structure', 'SEO', 'Copywriting'],
        'duration' => '9 weeks',
        'challenge' => 'The firm wanted a serious, almost classical tone - without the site looking like it was built in 2009. Half of their clients are international, so the English version had to be a first-class citizen.',
        'approach' => 'We took a calm, symmetrical grid and type with classical architectural motifs, then paired it with a contemporary layout and modern performance. Content is organised by practice area, because that is how clients search.',
        'result' => 'Organic traffic grew through the practice-area pages, and enquiries are more specific because clients already know what the firm does.',
        'highlights' => [
            ['briefcase', 'Practice areas', 'Nine dedicated pages written in the client\'s language, not the statute\'s.'],
            ['person', 'Team profiles', 'Credentials, languages and specialisations for every lawyer.'],
            ['search', 'SEO foundation', 'Structure, metadata and schema.org for legal services.'],
            ['grid', 'Bilingual', 'Serbian and English with hreflang pairs and no duplicates.'],
            ['check2-circle', 'Form protection', 'Honeypot and reCAPTCHA - no spam enquiry reaches the team.'],
            ['palette2', 'Visual tone', 'Classical motifs in a modern, readable form.'],
        ],
        'shots' => ['Home page with practice areas', 'Visual identity and printed materials', 'Internal enquiry log'],
    ],
],

/* ══════════════════════════ SOCIAL MEDIA ══════════════════════════ */

'bruno-coffee' => [
    'cat' => 'social', 'a1' => '#5dd3f5', 'a2' => '#cffbf6', 'year' => '2025',
    'seed' => 149, 'featured' => true, 'url' => null,
    'art' => ['cover' => 'social', 'shots' => ['social', 'brand', 'analytics']],
    'social' => [
        'handle' => '@brunocoffee',
        'channels' => [
            ['instagram', 'Instagram', '@brunocoffee'],
            ['tiktok', 'TikTok', '@brunocoffee'],
        ],
    ],
    'stack' => ['Meta Ads', 'Figma', 'Later', 'CapCut'],
    'metrics' => [
        ['v' => 14, 'suf' => 'k', 'sr' => 'novih pratilaca u 6 meseci', 'en' => 'new followers in 6 months'],
        ['v' => 5,  'suf' => 'x', 'sr' => 'veći doseg po objavi',       'en' => 'higher reach per post'],
        ['v' => 31, 'suf' => '%', 'sr' => 'porast prodaje u radnji',    'en' => 'growth in in-store sales'],
    ],
    'sr' => [
        'client' => 'Bruno Coffee Roasters', 'title' => 'Bruno Coffee',
        'sector' => 'Pržionica kafe',
        'tagline' => 'Instagram nalog pržionice pretvoren u kanal koji dovodi ljude u radnju.',
        'summary' => 'Content sistem umesto slučajnih objava: prepoznatljiv vizuelni ritam, serija reels-a o pripremi i zajednica koja komentare pretvara u posete.',
        'services' => ['Vođenje mreža', 'Produkcija sadržaja', 'Reels', 'Meta Ads'],
        'duration' => 'Kontinuirano, 12+ meseci',
        'challenge' => 'Nalog je imao dobre fotografije i nikakav ritam: objava kad se ko seti, bez teme, bez poziva na akciju. Ljudi su hvalili slike, a niko nije dolazio u radnju.',
        'approach' => 'Postavili smo tri stalne rubrike (poreklo zrna, priprema, ljudi iza šanka) i mrežu koja se čita kao celina. Reels-i su snimani u jednoj sesiji za ceo mesec, a oglašavanje ciljano na ljude u krugu od tri kilometra.',
        'result' => 'Nalog raste organski i vodi ka pultu: kod za popust iz story-ja koristi se svakodnevno, a subotnja degustacija puni radnju bez dodatnog oglašavanja.',
        'pillars' => [
            ['Poreklo zrna', 'Farma, sorta i način obrade - priča koja objašnjava zašto kafa ima taj ukus.', ['Karusel', 'Story']],
            ['Priprema', 'Kratke forme o doziranju, mlevenju i vremenu ekstrakcije, snimljene na šanku.', ['Reels', 'TikTok']],
            ['Ljudi iza šanka', 'Bariste, gosti i svakodnevni ritam radnje - lica koja se prepoznaju pre ulaska.', ['Reels', 'Objava']],
        ],
        'rhythm' => [
            ['Svaki dan', 'Story iz radnje'],
            ['Utorak', 'Poreklo zrna'],
            ['Četvrtak', 'Priprema - reels'],
            ['Subota', 'Najava degustacije'],
        ],
        'highlights' => [
            ['grid', 'Vizuelni ritam', 'Mreža profila planirana devet polja unapred.'],
            ['phone', 'Reels serija', 'Kratke forme o pripremi - najbolji izvor novog dosega.'],
            ['chat-dots', 'Zajednica', 'Odgovor na svaki komentar i poruku u toku istog dana.'],
            ['send-fill', 'Meta Ads', 'Lokalno ciljanje u krugu od tri kilometra od radnje.'],
            ['bar-chart', 'Mesečni izveštaj', 'Doseg, snimljeni sadržaj i šta je stvarno dovelo ljude.'],
            ['palette2', 'Content plan', 'Tri rubrike i kalendar objava mesec dana unapred.'],
        ],
        'shots' => ['Profil i mreža objava', 'Vizuelni identitet i ambalaža', 'Mesečni izveštaj o dosegu'],
    ],
    'en' => [
        'client' => 'Bruno Coffee Roasters', 'title' => 'Bruno Coffee',
        'sector' => 'Coffee roastery',
        'tagline' => 'A roastery Instagram account turned into a channel that brings people into the shop.',
        'summary' => 'A content system instead of random posts: a recognisable visual rhythm, a reels series about brewing, and a community that turns comments into visits.',
        'services' => ['Social media management', 'Content production', 'Reels', 'Meta Ads'],
        'duration' => 'Ongoing, 12+ months',
        'challenge' => 'The account had good photography and no rhythm: posts whenever someone remembered, with no theme and no call to action. People praised the pictures and nobody came into the shop.',
        'approach' => 'We set three recurring formats (bean origin, brewing, the people behind the bar) and a grid that reads as a whole. Reels were shot in one session per month, and ads were targeted at people within three kilometres.',
        'result' => 'The account grows organically and leads to the counter: the story discount code is used daily, and the Saturday tasting fills the shop with no extra spend.',
        'pillars' => [
            ['Bean origin', 'Farm, variety and processing - the story that explains why the coffee tastes the way it does.', ['Carousel', 'Story']],
            ['Brewing', 'Short formats on dose, grind and extraction time, filmed at the bar.', ['Reels', 'TikTok']],
            ['People behind the bar', 'Baristas, regulars and the daily rhythm of the shop - faces you recognise before walking in.', ['Reels', 'Post']],
        ],
        'rhythm' => [
            ['Every day', 'Story from the shop'],
            ['Tuesday', 'Bean origin'],
            ['Thursday', 'Brewing - reels'],
            ['Saturday', 'Tasting announcement'],
        ],
        'highlights' => [
            ['grid', 'Visual rhythm', 'The profile grid is planned nine tiles ahead.'],
            ['phone', 'Reels series', 'Short brewing formats - the best source of new reach.'],
            ['chat-dots', 'Community', 'Every comment and message answered the same day.'],
            ['send-fill', 'Meta Ads', 'Local targeting within three kilometres of the shop.'],
            ['bar-chart', 'Monthly report', 'Reach, content shot and what actually brought people in.'],
            ['palette2', 'Content plan', 'Three formats and a posting calendar a month ahead.'],
        ],
        'shots' => ['Profile and post grid', 'Visual identity and packaging', 'Monthly reach report'],
    ],
],

'padel-republic' => [
    'cat' => 'social', 'a1' => '#cffbf6', 'a2' => '#5dd3f5', 'year' => '2025',
    'seed' => 167, 'featured' => true, 'url' => null,
    'art' => ['cover' => 'social', 'shots' => ['social', 'mobile', 'analytics']],
    'social' => [
        'handle' => '@padelrepublic',
        'channels' => [
            ['instagram', 'Instagram', '@padelrepublic'],
            ['tiktok', 'TikTok', '@padelrepublic'],
            ['play-fill', 'YouTube Shorts', 'Padel Republic'],
        ],
    ],
    'stack' => ['CapCut', 'Meta Ads', 'Figma', 'Notion'],
    'metrics' => [
        ['v' => 480, 'suf' => 'k', 'sr' => 'pregleda najboljeg reels-a', 'en' => 'views on the best reel'],
        ['v' => 62,  'suf' => '%', 'sr' => 'više prijava na turnire',    'en' => 'more tournament sign-ups'],
        ['v' => 8,   'suf' => '',  'sr' => 'objava nedeljno, isti ritam','en' => 'posts a week, steady rhythm'],
    ],
    'sr' => [
        'client' => 'Padel Republic', 'title' => 'Padel Republic',
        'sector' => 'Sportski klub',
        'tagline' => 'Klupska zajednica izgrađena na kratkim formama i turnirima koji se sami popune.',
        'summary' => 'Sadržaj koji igrače pretvara u zajednicu: nedeljni highlight-ovi, poeni koji se dele, najave turnira i priče članova. Svaka objava vodi ka rezervaciji terena.',
        'services' => ['Vođenje mreža', 'Video produkcija', 'Zajednica', 'Oglašavanje'],
        'duration' => 'Kontinuirano, 10+ meseci',
        'challenge' => 'Klub je imao pune terene radnim danima i prazne subote, a nalog je bio galerija fotografija sa turnira bez ikakvog konteksta i bez poziva da se dođe.',
        'approach' => 'Umesto galerije, uveli smo nedeljni ritam: highlight poena u ponedeljak, savet u sredu, najava turnira u petak. Snimanje ide u jednoj sesiji nedeljno, a montaža je serijska da bi format ostao prepoznatljiv.',
        'result' => 'Prijave za turnire zatvaraju se pre roka, subote su pune, a igrači sami šalju svoje snimke za nedeljni highlight.',
        'pillars' => [
            ['Poen nedelje', 'Najbolji poen sa terena, montiran u petnaest sekundi - format koji članovi čekaju.', ['Reels', 'Shorts']],
            ['Savet trenera', 'Jedna tehnika po objavi, objašnjena tako da može da se primeni istog dana.', ['Reels', 'Karusel']],
            ['Najava turnira', 'Termin, kategorija i broj slobodnih mesta, sa linkom za prijavu u opisu.', ['Objava', 'Story']],
        ],
        'rhythm' => [
            ['Ponedeljak', 'Poen nedelje'],
            ['Sreda', 'Savet trenera'],
            ['Petak', 'Najava turnira'],
            ['Svaki dan', 'Story sa terena'],
        ],
        'highlights' => [
            ['phone', 'Kratke forme', 'Vertikalni video za Reels, TikTok i Shorts iz iste sesije.'],
            ['star-fill', 'Poen nedelje', 'Format koji članovi čekaju i sami popunjavaju sadržajem.'],
            ['calendar-check', 'Najave turnira', 'Prijave preko linka, sa podsetnikom pre zatvaranja liste.'],
            ['chat-dots', 'Zajednica', 'Grupe, ankete i story pitanja koja članovi zaista koriste.'],
            ['send-fill', 'Ciljano oglašavanje', 'Kampanje za početnike i za rekreativce, odvojeno.'],
            ['bar-chart', 'Merenje', 'Prijave i rezervacije pripisane konkretnoj objavi.'],
        ],
        'shots' => ['Profil kluba i mreža objava', 'Mobilni tok prijave na turnir', 'Analitika dosega po formatu'],
    ],
    'en' => [
        'client' => 'Padel Republic', 'title' => 'Padel Republic',
        'sector' => 'Sports club',
        'tagline' => 'A club community built on short-form video and tournaments that fill themselves.',
        'summary' => 'Content that turns players into a community: weekly highlights, shareable points, tournament announcements and member stories. Every post leads to a court booking.',
        'services' => ['Social media management', 'Video production', 'Community', 'Advertising'],
        'duration' => 'Ongoing, 10+ months',
        'challenge' => 'The club had full courts on weekdays and empty Saturdays, while the account was a gallery of tournament photos with no context and no invitation to show up.',
        'approach' => 'Instead of a gallery we introduced a weekly rhythm: point highlight on Monday, a tip on Wednesday, tournament announcement on Friday. Filming happens in one session per week and editing is serialised so the format stays recognisable.',
        'result' => 'Tournament sign-ups close before the deadline, Saturdays are full, and players send in their own clips for the weekly highlight.',
        'pillars' => [
            ['Point of the week', 'The best point from the courts, cut to fifteen seconds - the format members wait for.', ['Reels', 'Shorts']],
            ['Coach tip', 'One technique per post, explained so it can be used the same day.', ['Reels', 'Carousel']],
            ['Tournament announcement', 'Date, category and remaining places, with the sign-up link in the caption.', ['Post', 'Story']],
        ],
        'rhythm' => [
            ['Monday', 'Point of the week'],
            ['Wednesday', 'Coach tip'],
            ['Friday', 'Tournament announcement'],
            ['Every day', 'Story from the courts'],
        ],
        'highlights' => [
            ['phone', 'Short form', 'Vertical video for Reels, TikTok and Shorts from one session.'],
            ['star-fill', 'Point of the week', 'A format members wait for and fill with their own content.'],
            ['calendar-check', 'Tournament announcements', 'Sign-ups via link, with a reminder before the list closes.'],
            ['chat-dots', 'Community', 'Groups, polls and story questions members actually use.'],
            ['send-fill', 'Targeted ads', 'Separate campaigns for beginners and for regular players.'],
            ['bar-chart', 'Measurement', 'Sign-ups and bookings attributed to a specific post.'],
        ],
        'shots' => ['Club profile and post grid', 'Mobile tournament sign-up flow', 'Reach analytics by format'],
    ],
],

'mirella-cosmetics' => [
    'cat' => 'social', 'a1' => '#5d54b8', 'a2' => '#abbbe5', 'year' => '2024',
    'seed' => 191, 'featured' => false, 'url' => null,
    'art' => ['cover' => 'social', 'shots' => ['social', 'shop', 'analytics']],
    'social' => [
        'handle' => '@mirella.cosmetics',
        'channels' => [
            ['instagram', 'Instagram', '@mirella.cosmetics'],
            ['tiktok', 'TikTok', '@mirellacosmetics'],
        ],
    ],
    'stack' => ['UGC program', 'Meta Ads', 'Shopify', 'Figma'],
    'metrics' => [
        ['v' => 3,  'suf' => 'x', 'sr' => 'veći promet iz mreža',       'en' => 'more revenue from social'],
        ['v' => 46, 'suf' => '',  'sr' => 'UGC videa u prvoj sezoni',   'en' => 'UGC videos in season one'],
        ['v' => 2,  'suf' => '',  'sr' => 'ROAS na hladnoj publici',    'en' => 'ROAS on cold audiences'],
    ],
    'sr' => [
        'client' => 'Mirella Cosmetics', 'title' => 'Mirella',
        'sector' => 'Kozmetika',
        'tagline' => 'UGC mašina za kozmetički brend - sadržaj kupaca kao glavni prodajni kanal.',
        'summary' => 'Program u kome kupci prave sadržaj, a mi ga pretvaramo u kampanje. Rezultat: stalan tok autentičnih videa i oglasi koji ne izgledaju kao oglasi.',
        'services' => ['Vođenje mreža', 'UGC program', 'Meta Ads', 'Strategija sadržaja'],
        'duration' => 'Kontinuirano, 8+ meseci',
        'challenge' => 'Brend je imao lep, ali „katalog“ sadržaj - savršene fotografije proizvoda koje niko ne deli. Oglašavanje je gorelo budžet na hladnoj publici jer poverenja nije bilo.',
        'approach' => 'Postavili smo UGC program: brief, slanje proizvoda, jasan format i pravo na korišćenje snimka. Najbolje snimke smo pretvorili u oglase, a rutinu upotrebe u serijal koji objašnjava proizvod pre nego što ga proda.',
        'result' => 'Hladna publika prvo vidi drugu osobu, ne proizvod, i konverzija je vidljivo bolja. Brend danas ima stalnu biblioteku svežih snimaka.',
        'pillars' => [
            ['UGC recenzije', 'Kupci snimaju svoje iskustvo po jasnom brief-u, a najbolji snimci postaju oglasi.', ['Reels', 'TikTok']],
            ['Rutina upotrebe', 'Redosled proizvoda i količina - sadržaj koji objašnjava pre nego što prodaje.', ['Reels', 'Karusel']],
            ['Pre i posle', 'Rezultat kroz vreme, uz recenziju kupca u istoj objavi.', ['Karusel', 'Story']],
        ],
        'rhythm' => [
            ['Ponedeljak', 'UGC recenzija'],
            ['Sreda', 'Rutina upotrebe'],
            ['Petak', 'Pre i posle'],
            ['Svaki dan', 'Story i ankete'],
        ],
        'highlights' => [
            ['person', 'UGC program', 'Brief, isporuka proizvoda i saglasnost za korišćenje snimka.'],
            ['phone', 'Vertikalni format', 'Sadržaj snimljen za telefon, ne prepravljen za njega.'],
            ['send-fill', 'Oglasi iz UGC-a', 'Najbolji organski snimci postaju najbolji oglasi.'],
            ['cart', 'Do korpe', 'Direktna veza objave, proizvoda i korpe bez dodatnog koraka.'],
            ['bar-chart', 'Testiranje', 'Po tri varijante hook-a na svaki snimak.'],
            ['star-fill', 'Društveni dokaz', 'Recenzije i pre/posle sadržaj u istoj priči.'],
        ],
        'shots' => ['Profil sa UGC sadržajem', 'Stranica proizvoda i korpa', 'Rezultati kampanja po formatu'],
    ],
    'en' => [
        'client' => 'Mirella Cosmetics', 'title' => 'Mirella',
        'sector' => 'Cosmetics',
        'tagline' => 'A UGC engine for a cosmetics brand - customer content as the main sales channel.',
        'summary' => 'A programme where customers create the content and we turn it into campaigns. The result: a steady flow of authentic video and ads that do not look like ads.',
        'services' => ['Social media management', 'UGC programme', 'Meta Ads', 'Content strategy'],
        'duration' => 'Ongoing, 8+ months',
        'challenge' => 'The brand had beautiful but "catalogue" content - perfect product photography nobody shares. Advertising burned budget on cold audiences because there was no trust.',
        'approach' => 'We set up a UGC programme: brief, product shipping, a clear format and usage rights. The best clips became ads, and everyday use became a series that explains the product before selling it.',
        'result' => 'Cold audiences now see a person first, not a product, and conversion is visibly better. The brand has a permanent library of fresh footage.',
        'pillars' => [
            ['UGC reviews', 'Customers film their own experience from a clear brief, and the best clips become ads.', ['Reels', 'TikTok']],
            ['Usage routine', 'Product order and quantity - content that explains before it sells.', ['Reels', 'Carousel']],
            ['Before and after', 'The result over time, with the customer review in the same post.', ['Carousel', 'Story']],
        ],
        'rhythm' => [
            ['Monday', 'UGC review'],
            ['Wednesday', 'Usage routine'],
            ['Friday', 'Before and after'],
            ['Every day', 'Stories and polls'],
        ],
        'highlights' => [
            ['person', 'UGC programme', 'Brief, product delivery and consent for footage use.'],
            ['phone', 'Vertical format', 'Content shot for the phone, not reframed for it.'],
            ['send-fill', 'Ads from UGC', 'The best organic clips become the best ads.'],
            ['cart', 'Straight to basket', 'Post, product and basket connected with no extra step.'],
            ['bar-chart', 'Testing', 'Three hook variants for every clip.'],
            ['star-fill', 'Social proof', 'Reviews and before/after content in the same story.'],
        ],
        'shots' => ['Profile with UGC content', 'Product page and basket', 'Campaign results by format'],
    ],
],

'fitlab-studio' => [
    'cat' => 'social', 'a1' => '#cffbf6', 'a2' => '#abbbe5', 'year' => '2024',
    'seed' => 211, 'featured' => false, 'url' => null,
    'art' => ['cover' => 'social', 'shots' => ['social', 'mobile', 'brand']],
    'social' => [
        'handle' => '@fitlab.studio',
        'channels' => [
            ['instagram', 'Instagram', '@fitlab.studio'],
            ['tiktok', 'TikTok', '@fitlabstudio'],
            ['facebook', 'Facebook', 'FitLab Studio'],
        ],
    ],
    'stack' => ['Meta Ads', 'Figma', 'Notion', 'CapCut'],
    'metrics' => [
        ['v' => 120, 'suf' => '',  'sr' => 'novih članova u sezoni',   'en' => 'new members in one season'],
        ['v' => 7,   'suf' => '%', 'sr' => 'engagement na profilu',    'en' => 'profile engagement rate'],
        ['v' => 24,  'suf' => '',  'sr' => 'objava mesečno, planirano','en' => 'posts a month, planned'],
    ],
    'sr' => [
        'client' => 'FitLab Studio', 'title' => 'FitLab',
        'sector' => 'Fitnes studio',
        'tagline' => 'Content sistem za fitnes studio koji besplatan probni trening prodaje sam.',
        'summary' => 'Jedan snimački dan mesečno, četiri nedelje sadržaja. Treneri postaju lica brenda, a svaka nedelja završava jasnim pozivom na probni trening.',
        'services' => ['Vođenje mreža', 'Produkcija', 'Meta Ads', 'Content strategija'],
        'duration' => 'Kontinuirano, 9+ meseci',
        'challenge' => 'Studio je objavljivao stok fotografije i motivacione citate. Publika nije znala ko su treneri, kako izgleda trening, ni kako se uopšte prijaviti.',
        'approach' => 'Napravili smo produkcijski dan: jedno snimanje mesečno pokriva vežbe, trenere i atmosferu za ceo mesec. Sadržaj je organizovan u nedeljne teme, a svaka se zaključava pozivom na probni trening sa merljivim linkom.',
        'result' => 'Prijave za probni trening dolaze svakodnevno, a studio prvi put zna koja tema i koji trener donose najviše dolazaka.',
        'pillars' => [
            ['Vežba nedelje', 'Jedna vežba, tri nivoa težine i jasna korist - format koji se lako ponavlja.', ['Reels', 'TikTok']],
            ['Treneri', 'Ko vodi koji trening, kako radi i zašto - poverenje pre prvog dolaska.', ['Reels', 'Objava']],
            ['Atmosfera studija', 'Grupni treninzi, muzika i prostor - kako izgleda običan dan u sali.', ['Story', 'Reels']],
        ],
        'rhythm' => [
            ['Ponedeljak', 'Vežba nedelje'],
            ['Sreda', 'Trener u fokusu'],
            ['Petak', 'Atmosfera treninga'],
            ['Svaki dan', 'Story i prijave'],
        ],
        'highlights' => [
            ['palette2', 'Produkcijski dan', 'Jedno snimanje mesečno = četiri nedelje sadržaja.'],
            ['person', 'Treneri kao lica', 'Ljudi, ne stok fotografije - poverenje pre dolaska.'],
            ['phone', 'Vežba nedelje', 'Kratka forma sa jasnom korišću i pozivom na akciju.'],
            ['send-fill', 'Kampanje', 'Lokalno oglašavanje sa merljivim prijavama.'],
            ['calendar-check', 'Kalendar objava', 'Mesec dana unapred, bez improvizacije.'],
            ['bar-chart', 'Izveštaj', 'Prijave i dolasci pripisani objavi i treneru.'],
        ],
        'shots' => ['Profil studija i mreža objava', 'Mobilna prijava za probni trening', 'Vizuelni identitet i materijali'],
    ],
    'en' => [
        'client' => 'FitLab Studio', 'title' => 'FitLab',
        'sector' => 'Fitness studio',
        'tagline' => 'A content system for a fitness studio that sells the free trial session on its own.',
        'summary' => 'One shooting day a month, four weeks of content. Coaches become the face of the brand, and every week closes with a clear call to book a trial session.',
        'services' => ['Social media management', 'Production', 'Meta Ads', 'Content strategy'],
        'duration' => 'Ongoing, 9+ months',
        'challenge' => 'The studio was posting stock photography and motivational quotes. The audience did not know who the coaches were, what a session looked like, or how to sign up at all.',
        'approach' => 'We built a production day: one shoot per month covers exercises, coaches and atmosphere for four weeks. Content is organised into weekly themes, each closing with a trial-session call to action on a measurable link.',
        'result' => 'Trial bookings come in daily, and for the first time the studio knows which theme and which coach bring the most visits.',
        'pillars' => [
            ['Exercise of the week', 'One exercise, three difficulty levels and a clear benefit - a format that repeats easily.', ['Reels', 'TikTok']],
            ['Coaches', 'Who runs which session, how they work and why - trust before the first visit.', ['Reels', 'Post']],
            ['Studio atmosphere', 'Group sessions, music and the room - what an ordinary day looks like.', ['Story', 'Reels']],
        ],
        'rhythm' => [
            ['Monday', 'Exercise of the week'],
            ['Wednesday', 'Coach in focus'],
            ['Friday', 'Training atmosphere'],
            ['Every day', 'Stories and sign-ups'],
        ],
        'highlights' => [
            ['palette2', 'Production day', 'One shoot a month = four weeks of content.'],
            ['person', 'Coaches as faces', 'People, not stock photos - trust before the first visit.'],
            ['phone', 'Exercise of the week', 'Short form with a clear benefit and call to action.'],
            ['send-fill', 'Campaigns', 'Local advertising with measurable sign-ups.'],
            ['calendar-check', 'Content calendar', 'A month ahead, with no improvisation.'],
            ['bar-chart', 'Reporting', 'Sign-ups and visits attributed to post and coach.'],
        ],
        'shots' => ['Studio profile and post grid', 'Mobile trial-session sign-up', 'Visual identity and materials'],
    ],
],

    ];
}

/** Nazivi kategorija (bilingvalno). Ključ 'all' je pseudo-kategorija za filter. */
function vug_project_cat_labels(string $lang = 'sr'): array {
    // Nazivi i redosled prate usluge sa početne strane (sajtovi -> web aplikacije
    // -> društvene mreže), da filter govori istim jezikom kao ostatak sajta.
    $l = [
        'sr' => ['all' => 'Svi projekti', 'web' => 'Sajtovi', 'web-app' => 'Web aplikacije', 'social' => 'Društvene mreže'],
        'en' => ['all' => 'All projects', 'web' => 'Websites', 'web-app' => 'Web apps', 'social' => 'Social media'],
    ];
    return $l[$lang] ?? $l['sr'];
}

/**
 * Svi projekti u jednom jeziku - spljošteno (baza + tekstovi + putanje slika).
 * @param string $lang  'sr'|'en'
 * @param string|null $cat  filtriraj po kategoriji ('web-app'|'web'|'social')
 * @param bool $featured_only  samo projekti za početnu stranu
 */
function vug_projects(string $lang = 'sr', ?string $cat = null, bool $featured_only = false): array {
    $lang = $lang === 'en' ? 'en' : 'sr';
    $out  = [];
    foreach (vug_projects_raw() as $slug => $p) {
        if ($cat !== null && $p['cat'] !== $cat) continue;
        if ($featured_only && empty($p['featured'])) continue;

        $tx = $p[$lang];
        unset($p['sr'], $p['en']);
        $p['slug']      = $slug;
        $p['cat_label'] = vug_project_cat_labels($lang)[$p['cat']] ?? $p['cat'];
        $p['cover']     = 'img/projects/' . $slug . '-cover.svg';
        $p['gallery']   = [];
        foreach (array_values($p['art']['shots']) as $i => $kind) {
            $p['gallery'][] = [
                'src'     => 'img/projects/' . $slug . '-' . ($i + 1) . '.svg',
                'caption' => $tx['shots'][$i] ?? '',
                'kind'    => $kind,
            ];
        }
        // Social projekti dobijaju i vizuale specifične za kanal (vidi
        // php/project-art.php): mrežu profila 1:1 i vertikalne 9:16 prikaze,
        // jedan po rubrici, pa "Rubrike" i "Sadržaj" govore o istoj stvari.
        if ($p['cat'] === 'social') {
            $p['grid_art'] = 'img/projects/' . $slug . '-grid.svg';
            $p['reels']    = [];
            foreach (array_values($tx['pillars'] ?? []) as $i => $pl) {
                $p['reels'][] = [
                    'src'   => 'img/projects/' . $slug . '-r' . ($i + 1) . '.svg',
                    'label' => $pl[0],
                    'desc'  => $pl[1] ?? '',
                    'tags'  => $pl[2] ?? [],
                ];
            }
        }

        // Metrike: numerička vrednost + sufiks + jezički label
        $mm = [];
        foreach ($p['metrics'] as $m) {
            $mm[] = ['v' => $m['v'], 'suf' => $m['suf'], 'label' => $m[$lang] ?? ''];
        }
        $p['metrics'] = $mm;
        unset($tx['shots']);
        $out[$slug] = array_merge($p, $tx);
    }
    return $out;
}

/** Jedan projekat ili null ako slug ne postoji. */
function vug_project(string $slug, string $lang = 'sr'): ?array {
    $all = vug_projects($lang);
    return $all[$slug] ?? null;
}

/** Prethodni/sledeći projekat (kružno) - za navigaciju na dnu detalja. */
function vug_project_siblings(string $slug, string $lang = 'sr'): array {
    $all   = vug_projects($lang);
    $keys  = array_keys($all);
    $i     = array_search($slug, $keys, true);
    if ($i === false) return ['prev' => null, 'next' => null];
    $n     = count($keys);
    return [
        'prev' => $all[$keys[($i - 1 + $n) % $n]],
        'next' => $all[$keys[($i + 1) % $n]],
    ];
}

/**
 * Šablon stranice projekta: 'social' za vođenje društvenih mreža, 'web' za
 * sajtove i web aplikacije. Vidi partials/project-<sablon>.php.
 */
function vug_project_template(array $p): string {
    return ($p['cat'] ?? '') === 'social' ? 'social' : 'web';
}

/**
 * Host iz live URL-a projekta (za "browser" traku na web projektima).
 * Vraća '' kad projekat nema javni link - traka tada prikazuje naziv projekta.
 */
function vug_project_host(?string $url): string {
    if (!$url) return '';
    $h = parse_url($url, PHP_URL_HOST) ?: '';
    return preg_replace('/^www\./', '', $h);
}

/** URL portfolio stranice (base-path aware, po jeziku). */
function vug_projects_url(string $base, string $lang): string {
    return $lang === 'en' ? $base . '/en/projects' : $base . '/projekti';
}

/** URL pojedinačnog projekta. */
function vug_project_url(string $base, string $lang, string $slug): string {
    return vug_projects_url($base, $lang) . '/' . $slug;
}

}
