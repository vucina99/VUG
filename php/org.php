<?php
/**
 * VUG - podaci o firmi za JSON-LD (Organization + ProfessionalService).
 *
 * JEDAN izvor za početnu (index.php) i landing stranice (landing.php, kao
 * `provider`). Isti @id na svim stranicama -> Google spaja čvorove u jedan
 * entitet. Do 2026-10-22 je ovaj niz bio prepisan u oba fajla i već se
 * razilazio (hasMap samo na landing stranicama, različito areaServed).
 *
 * MORA da se poklapa sa Google poslovnim profilom (naziv, adresa, telefon,
 * radno vreme) - neslaganje pravi konflikt entiteta i šteti lokalnom rangiranju.
 *
 * Namerno BEZ:
 *   - 'email' (u <script> bloku HTML entiteti se ne dekodiraju, adresa bi
 *     stajala kao čist tekst u izvoru - pravilo iz CLAUDE.md);
 *   - review / aggregateRating (self-serving recenzije - vidi index.php).
 */

const VUG_BRAND_NAME = 'VUG Digital Agency';
const VUG_BRAND_ALT  = ['VUG', 'VUG Agency', 'VUG agencija'];

// Profili na društvenim mrežama + Google poslovni profil (sameAs).
// Poslovni profil je Knowledge Graph entitet /g/11nr8fvrkb - dobijen 2026-10-27
// razrešavanjem linka contact_info_maps_url (share.google/...). kgmid URL je
// stabilan; share.google je kratak link koji vodi na isti entitet.
const VUG_SAME_AS = [
    'https://www.instagram.com/vugagency',
    'https://www.facebook.com/profile.php?id=61592111037904',
    'https://www.linkedin.com/company/vug-digital-agency/',
    'https://www.google.com/search?kgmid=/g/11nr8fvrkb',
];

function vug_org_schema(string $site_url, string $lang, string $phone_intl): array
{
    return [
        '@type' => ['Organization', 'ProfessionalService'],
        '@id' => $site_url . '/#organization',
        'name' => VUG_BRAND_NAME,
        'alternateName' => VUG_BRAND_ALT,
        'url' => $site_url . '/',
        'logo' => ['@type' => 'ImageObject', 'url' => $site_url . '/img/icon-512.png', 'width' => 512, 'height' => 512],
        'image' => $site_url . '/img/og-image.png',
        'telephone' => $phone_intl,
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Vojvođanska 12b',
            'addressLocality' => 'Pančevo',
            'postalCode' => '26000',
            'addressRegion' => 'Vojvodina',
            'addressCountry' => 'RS',
        ],
        // Tačne koordinate sedišta - brojevi, ne stringovi.
        'geo' => ['@type' => 'GeoCoordinates', 'latitude' => 44.8804099, 'longitude' => 20.6663928],
        // Naziv + adresa, ne koordinate: sa koordinatama mapa pokaže samo pin, a
        // sa nazivom Google otvori poslovni profil (isto pravilo kao ugrađena mapa).
        'hasMap' => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('VUG Digital Agency, Vojvođanska 12b, 26000 Pančevo'),
        // Agencija radi za celu Srbiju (Beograd i Pančevo su samo blaga ciljna
        // grupa) - zato Srbija, a ne „Worldwide“ ni jedan grad. Gradovi i okolna
        // mesta idu u areaServed na Service čvoru landing stranica.
        'areaServed' => ['@type' => 'Country', 'name' => $lang === 'sr' ? 'Srbija' : 'Serbia'],
        'openingHoursSpecification' => [[
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens' => '00:00',
            'closes' => '23:59',
        ]],
        'knowsLanguage' => ['sr', 'en'],
        'sameAs' => VUG_SAME_AS,
    ];
}
