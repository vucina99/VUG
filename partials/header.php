<?php
/**
 * Deljeni header — uključuje se ODMAH posle <body> na svakoj stranici.
 * Emituje: SVG sprite, skip-link, pozadine (mesh/grain), custom cursor,
 * glavnu + mobilnu navigaciju i otvara <main id="main">.
 *
 * Zahteva (definisati PRE require-a):
 *   $t     — jezički niz (lang/*.php)
 *   $base  — bazna putanja bez kose crte na kraju ('' na produkciji, '/VUG digital' na lokalu)
 *   $home  — URL početne za trenutni jezik
 *
 * Opciono:
 *   $nav_prefix        — prefiks za sidra ('' na početnoj, $home na podstranicama)  [default '']
 *   $contact_href      — link stavke "Kontakt"                    [default $nav_prefix.'#contact']
 *   $cta_href          — link CTA dugmeta u navigaciji            [default $contact_href]
 *   $show_lang_toggle  — prikaži prekidač jezika                  [default true]
 *   $href_other        — URL druge jezičke verzije (za prekidač)
 */
$nav_prefix       = $nav_prefix       ?? '';
$contact_href     = $contact_href     ?? ($nav_prefix . '#contact');
$cta_href         = $cta_href         ?? $contact_href;
$show_lang_toggle = $show_lang_toggle ?? true;
$is_sr            = (($t['lang_code'] ?? 'sr') === 'sr');
?>
<?= vug_icon_sprite() ?>

<a class="skip-link" href="#main"><?= $is_sr ? 'Pređi na sadržaj' : 'Skip to content' ?></a>

<!-- Gradient mesh BG -->
<div class="mesh" aria-hidden="true"></div>
<div class="grain" aria-hidden="true"></div>

<!-- Custom cursor -->
<div class="cursor" id="cursor" aria-hidden="true"></div>
<div class="cursor-ring" id="cursorRing" aria-hidden="true"></div>

<!-- NAV -->
<nav class="nav" id="nav" aria-label="<?= $is_sr ? 'Glavna navigacija' : 'Main navigation' ?>">
    <div class="container nav-inner">
        <a href="<?= $home ?>" class="brand" aria-label="VUG — <?= $is_sr ? 'Početna' : 'Home' ?>">
            <img src="<?= $base ?>/img/logoes/logo-blue-white-c-2x.png" alt="VUG Digital Agency" class="brand-logo" width="382" height="80">
        </a>

        <div class="nav-links">
            <a href="<?= $nav_prefix ?>#services" class="nav-link"><?= $t['nav_services'] ?></a>
            <a href="<?= $nav_prefix ?>#about" class="nav-link"><?= $t['nav_about'] ?></a>
            <a href="<?= $nav_prefix ?>#process" class="nav-link"><?= $t['nav_process'] ?></a>
            <a href="<?= $nav_prefix ?>#faq" class="nav-link"><?= $t['nav_faq'] ?></a>
            <a href="<?= $nav_prefix ?>#references" class="nav-link"><?= $t['nav_references'] ?></a>
            <a href="<?= $contact_href ?>" class="nav-link"><?= $t['nav_contact'] ?></a>
        </div>

        <div class="nav-actions">
            <?php if ($show_lang_toggle && !empty($href_other)): ?>
            <a href="<?= $href_other ?>" class="lang-toggle">
                <span class="now"><?= $t['lang_current_label'] ?></span>/<span class="other"><?= $t['lang_other_label'] ?></span>
            </a>
            <?php endif; ?>
            <a href="<?= $cta_href ?>" class="btn btn--primary is-magnetic"><?= $t['nav_cta'] ?></a>
            <button class="nav-toggle" id="navToggle" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>

<div class="nav-mobile" id="navMobile" role="navigation" aria-label="<?= $is_sr ? 'Mobilna navigacija' : 'Mobile navigation' ?>" aria-hidden="true">
    <a href="<?= $nav_prefix ?>#services"><?= $t['nav_services'] ?></a>
    <a href="<?= $nav_prefix ?>#about"><?= $t['nav_about'] ?></a>
    <a href="<?= $nav_prefix ?>#process"><?= $t['nav_process'] ?></a>
    <a href="<?= $nav_prefix ?>#faq"><?= $t['nav_faq'] ?></a>
    <a href="<?= $nav_prefix ?>#references"><?= $t['nav_references'] ?></a>
    <a href="<?= $contact_href ?>"><?= $t['nav_contact'] ?></a>
</div>

<main id="main">
