<?php
/**
 * Deljeni footer — uključuje se na KRAJU sadržaja svake stranice.
 * Zatvara <main>, emituje podnožje, dugme "na vrh", učitava main.js
 * i zatvara <body>/<html>.
 *
 * Zahteva (definisati PRE require-a):
 *   $t, $base, $home, $phone_clean, $lang
 *
 * Opciono:
 *   $nav_prefix   — prefiks za sidra ('' na početnoj, $home na podstranicama)  [default '']
 *   $contact_href — link stavke "Kontakt"                    [default $nav_prefix.'#contact']
 */
$nav_prefix   = $nav_prefix   ?? '';
$contact_href = $contact_href ?? ($nav_prefix . '#contact');
$is_sr        = (($t['lang_code'] ?? 'sr') === 'sr');
$legal_q      = (($lang ?? 'sr') === 'en') ? '?lang=en' : '';
$root         = dirname(__DIR__);
?>
</main>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div>
                <a href="<?= $home ?>" class="brand brand--footer">
                    <img src="<?= $base ?>/img/logoes/logo-blue-white-c-2x.png" alt="VUG Digital Agency" class="brand-logo" width="382" height="80" loading="lazy">
                </a>
                <p class="footer-tagline"><?= $t['footer_tagline'] ?></p>
                <div class="socials footer-socials">
                    <a href="https://www.instagram.com/vugagency" target="_blank" rel="noopener" aria-label="Instagram"><?= vug_icon('instagram') ?></a>
                    <a href="https://www.facebook.com/profile.php?id=61592111037904" target="_blank" rel="noopener" aria-label="Facebook"><?= vug_icon('facebook') ?></a>
                    <a href="https://www.linkedin.com/company/vug-digital-agency/" target="_blank" rel="noopener" aria-label="LinkedIn"><?= vug_icon('linkedin') ?></a>
                </div>
            </div>
            <div>
                <div class="footer-h"><?= $t['footer_nav'] ?></div>
                <ul class="footer-list">
                    <li><a href="<?= $nav_prefix ?>#services"><?= $t['nav_services'] ?></a></li>
                    <li><a href="<?= $nav_prefix ?>#about"><?= $t['nav_about'] ?></a></li>
                    <li><a href="<?= $nav_prefix ?>#process"><?= $t['nav_process'] ?></a></li>
                    <li><a href="<?= $nav_prefix ?>#faq"><?= $t['nav_faq'] ?></a></li>
                    <li><a href="<?= $nav_prefix ?>#references"><?= $t['nav_references'] ?></a></li>
                    <li><a href="<?= $contact_href ?>"><?= $t['nav_contact'] ?></a></li>
                </ul>
            </div>
            <div>
                <div class="footer-h"><?= $t['footer_services'] ?></div>
                <ul class="footer-list">
                    <li><a href="<?= $base ?>/izrada-web-sajta-beograd"><?= $is_sr ? 'Izrada web sajta Beograd' : 'Web design Beograd' ?></a></li>
                    <li><a href="<?= $base ?>/izrada-web-sajta-pancevo"><?= $is_sr ? 'Izrada web sajta Pančevo' : 'Web design Pančevo' ?></a></li>
                    <li><a href="<?= $base ?>/vodjenje-drustvenih-mreza-beograd"><?= $is_sr ? 'Vođenje mreža Beograd' : 'Social media Belgrade' ?></a></li>
                    <li><a href="<?= $base ?>/vodjenje-drustvenih-mreza-pancevo"><?= $is_sr ? 'Vođenje mreža Pančevo' : 'Social media Pančevo' ?></a></li>
                </ul>
            </div>
            <div>
                <div class="footer-h"><?= $t['footer_contact'] ?></div>
                <ul class="footer-list">
                    <li><?= vug_icon('envelope') ?><a href="<?= vug_email_obf('mailto:' . $t['contact_info_email']) ?>"><?= vug_email_obf($t['contact_info_email']) ?></a></li>
                    <li><?= vug_icon('telephone') ?><a href="tel:<?= $phone_clean ?>"><?= $t['contact_info_phone'] ?></a></li>
                    <li><?= vug_icon('geo-alt') ?><?= $t['contact_info_location'] ?></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; <?= date('Y') ?> VUG. <?= $t['footer_rights'] ?></span>
            <nav class="footer-legal" aria-label="<?= $t['footer_legal'] ?>">
                <a href="<?= $base ?>/politika-privatnosti<?= $legal_q ?>"><?= $t['footer_privacy'] ?></a>
                <a href="<?= $base ?>/uslovi-koriscenja<?= $legal_q ?>"><?= $t['footer_terms'] ?></a>
                <a href="<?= $base ?>/politika-kolacica<?= $legal_q ?>"><?= $t['footer_cookies'] ?></a>
            </nav>
            <span><?= $t['footer_made'] ?></span>
        </div>
    </div>
</footer>

<a href="#main" class="to-top" aria-label="Top"><?= vug_icon('arrow-up') ?></a>

<!-- reCAPTCHA se učitava LENJO (na prvu interakciju sa formom) preko js/main.js. -->
<script src="<?= $base ?>/js/main.js?v=<?= @filemtime($root . '/js/main.js') ?>" defer></script>
</body>
</html>
