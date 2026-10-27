# Arhiva: /izrada-web-sajta-pancevo (stanje 2026-10-26, commit add7cf8)

Sačuvana verzija stranice „Izrada web sajta Pančevo“ sa SVIM proširenim sekcijama,
pre nego što je 2026-10-26 zamenjena jednostavnom verzijom (hero + sekcija `01`),
kakva je bila pre proširenja iz septembra 2026.

Sadržaj sačuvane verzije: hero (dugmad „Pošaljite upit“ + „Pozovite odmah“) →
`01` Zašto VUG → `02` usluge → `03` proces → `04` delatnosti → `05` cena →
`06` recenzije (traka) → `07` česta pitanja (+ FAQPage JSON-LD) → `08` kontakt forma.

> **2026-10-27: proširena verzija je VRAĆENA** (rute ponovo idu na `landing.php`,
> `landing-web-pancevo.php` obrisan - jednostavna verzija je u commit-u `ef90fae`).
> Ova arhiva ostaje kao rezervna kopija.

## Fajlovi

- `landing.php` - kontroler kakav je bio (opslužuje svih 12 landing stranica).
- `php/landing-content.php` - prošireni sadržaj (usluge, proces, delatnosti, cena, FAQ).
- `snimak-stranice-sr.html`, `snimak-stranice-en.html` - renderovan HTML (samo za
  pregled teksta; putanje su lokalne, `/VUG digital/...`).

Folder `_arhiva/` je zatvoren za posetioce (`_arhiva/.htaccess`: `Require all denied`).

## Kako se vraća

Stara (proširena) verzija i dalje živi u `landing.php` - nova jednostavna stranica je
poseban fajl `landing-web-pancevo.php`, pa je vraćanje samo preusmeravanje rute:

1. U root `.htaccess` dva pravila za `izrada-web-sajta-pancevo` (SR i EN) vratiti sa
   `landing-web-pancevo.php...` na:
   ```
   RewriteRule ^en/izrada-web-sajta-pancevo/?$ landing.php?loc=pancevo&lang=en [L,QSA]
   RewriteRule ^izrada-web-sajta-pancevo/?$    landing.php?loc=pancevo [L,QSA]
   ```
2. Obrisati `landing-web-pancevo.php`.
3. Osvežiti `<lastmod>` za `/izrada-web-sajta-pancevo` u `sitemap.xml`.

Ako je `landing.php` ili `php/landing-content.php` u međuvremenu menjan tako da
Pančevo više ne izgleda kao ovde, prekopirati blok `'web' => ['pancevo' => ...]`
iz ovih arhivskih fajlova (ili ceo fajl, ako druge stranice nisu menjane).
Ili: `git show add7cf8:landing.php` / `git show add7cf8:php/landing-content.php`.
