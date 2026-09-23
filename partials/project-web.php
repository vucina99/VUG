<?php
/**
 * VUG — šablon stranice projekta za SAJTOVE I WEB APLIKACIJE (cat 'web' | 'web-app').
 * Uključuje ga projekat.php preko vug_project_template().
 *
 * Priča ovog šablona je proizvod: ekran u "browser" ramu, tok rada od zadatka
 * do rezultata, funkcionalnosti i tehnologija. Vizuali su 16:10 (desktop).
 *
 * Ritam sekcija je isti kao na početnoj (tamno -> svetlo -> tamno), a poslednja
 * sekcija je UVEK svetla jer je futer već taman.
 *
 * Očekuje iz projekat.php: $p, $t, $lang, $base, $home, $pf_url, $sib,
 * $contact_href, $phone_clean.
 */

$host = vug_project_host($p['url'] ?? null);
?>

<!-- HERO -->
<header class="hero hero--sub" id="project-top">
    <div class="hero-glow" id="heroGlow" aria-hidden="true"></div>
    <div class="container">
        <nav class="pd-crumbs" aria-label="Breadcrumb">
            <a href="<?= $home ?>"><?= htmlspecialchars($t['nav_home']) ?></a>
            <span class="sep">/</span>
            <a href="<?= $pf_url ?>"><?= htmlspecialchars($t['nav_projects']) ?></a>
            <span class="sep">/</span>
            <span><?= htmlspecialchars($p['title']) ?></span>
        </nav>

        <div class="pd-badges">
            <span class="pd-badge">
                <?= vug_icon($p['cat'] === 'web-app' ? 'code-slash' : 'globe') ?>
                <?= htmlspecialchars($p['cat_label']) ?>
            </span>
            <?php if (!empty($p['url'])): ?>
            <span class="pdw-live"><span class="dot"></span><?= htmlspecialchars($t['pdw_live']) ?></span>
            <?php endif; ?>
        </div>

        <h1 class="hero-title"><?= htmlspecialchars($p['title']) ?></h1>

        <p class="pd-tagline"><?= htmlspecialchars($p['tagline']) ?></p>

        <div class="hero-actions">
            <a href="<?= $contact_href ?>" class="btn btn--primary is-magnetic">
                <?= htmlspecialchars($t['cta_primary']) ?>
                <?= vug_icon('arrow-up-right') ?>
            </a>
            <?php if (!empty($p['url'])): ?>
            <a href="<?= htmlspecialchars($p['url']) ?>" class="btn btn--ghost" target="_blank" rel="noopener noreferrer">
                <?= vug_icon('box-arrow-up-right') ?>
                <?= htmlspecialchars($t['pd_visit']) ?>
            </a>
            <?php endif; ?>
        </div>

        <div class="pd-meta">
            <?php foreach ([
                [$t['pd_client'],   $p['client']],
                [$t['pd_sector'],   $p['sector']],
                [$t['pd_year'],     $p['year']],
                [$t['pd_duration'], $p['duration']],
            ] as $m): ?>
            <div>
                <div class="pd-meta-label"><?= htmlspecialchars($m[0]) ?></div>
                <div class="pd-meta-value"><?= htmlspecialchars($m[1]) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</header>

<!-- GLAVNI VIZUAL U "BROWSER" RAMU + METRIKE -->
<section class="pd-stage" aria-label="<?= htmlspecialchars($p['title']) ?>">
    <div class="container">
        <div class="pd-stage-glow" aria-hidden="true"></div>

        <div class="pdw-window js-tilt">
            <div class="pdw-bar" aria-hidden="true">
                <span class="pdw-dots"><i></i><i></i><i></i></span>
                <span class="pdw-url">
                    <?= vug_icon('globe') ?>
                    <?= htmlspecialchars($host !== '' ? $host : $p['title'] . ' — ' . $t['pdw_preview']) ?>
                </span>
                <span class="pdw-tools"><i></i><i></i></span>
            </div>
            <img src="<?= $base ?>/<?= $p['cover'] ?>"
                 alt="<?= htmlspecialchars($p['title'] . ' — ' . $p['cat_label']) ?>"
                 width="1200" height="750" decoding="async" fetchpriority="high">
        </div>

        <div class="pd-metrics reveal">
            <?php foreach ($p['metrics'] as $m): ?>
            <div class="pd-metric">
                <div class="v"><span class="counter" data-target="<?= (int) $m['v'] ?>" data-suffix="<?= htmlspecialchars($m['suf']) ?>">0</span></div>
                <div class="l"><?= htmlspecialchars($m['label']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 01 — PRIČA: rezime + tok od zadatka do rezultata -->
<section class="section section--cream" id="story" aria-labelledby="story-title">
    <div class="container">
        <div class="s-head reveal" style="margin-bottom: clamp(36px, 4vw, 64px);">
            <div class="s-index"><strong>01</strong><span class="line"></span><span><?= htmlspecialchars($t['pd_story_eyebrow']) ?></span></div>
            <h2 class="s-title" id="story-title" style="font-size: clamp(32px, 4.4vw, 60px);"><?= htmlspecialchars($t['pd_story_title']) ?></h2>
        </div>

        <div class="pd-story">
            <div class="pd-story-aside reveal">
                <p class="pd-summary"><?= htmlspecialchars($p['summary']) ?></p>
                <div class="pd-meta-label" style="margin-top: 34px;"><?= htmlspecialchars($t['pd_services_label']) ?></div>
                <div class="pd-services">
                    <?php foreach ($p['services'] as $svc): ?>
                        <span class="pd-service"><?= htmlspecialchars($svc) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <ol class="pdw-flow stagger">
                <?php foreach ([
                    ['01', $t['pd_challenge'], $p['challenge']],
                    ['02', $t['pd_approach'],  $p['approach']],
                    ['03', $t['pd_result'],    $p['result']],
                ] as $step): ?>
                <li class="pdw-step">
                    <span class="pdw-step-dot" aria-hidden="true"></span>
                    <div class="pdw-step-head">
                        <span class="pdw-step-n"><?= $step[0] ?></span>
                        <h3 class="pdw-step-title"><?= htmlspecialchars($step[1]) ?></h3>
                    </div>
                    <p><?= htmlspecialchars($step[2]) ?></p>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</section>

<!-- 02 — FUNKCIONALNOSTI: polja razdvojena samo linijama (isti jezik kao .pf-areas) -->
<section class="section section--light" id="delivered" aria-labelledby="delivered-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>02</strong><span class="line"></span><span><?= htmlspecialchars($t['pd_highlights_eyebrow']) ?></span></div>
            <h2 class="s-title" id="delivered-title"><?= htmlspecialchars($t['pd_highlights_title']) ?></h2>
        </div>

        <div class="pdw-feat stagger">
            <?php foreach ($p['highlights'] as $i => $h): ?>
            <div class="pdw-feat-item">
                <span class="pdw-feat-n"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                <div class="pdw-feat-body">
                    <h3 class="pdw-feat-title">
                        <span class="pdw-feat-ic"><?= vug_icon($h[0]) ?></span>
                        <?= htmlspecialchars($h[1]) ?>
                    </h3>
                    <p class="pdw-feat-desc"><?= htmlspecialchars($h[2]) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Tehnologije: kompaktan red na dnu iste sekcije, bez numeracije i bez
             svoje sekcije (izbor korisnika 2026-08-05 — kraj stranice je bio
             razvučen na tri bloka, a brojevi 01-05 uz PHP/MySQL ne znače ništa). -->
        <div class="pd-tech reveal">
            <div class="pd-meta-label"><?= htmlspecialchars($t['pd_stack_title']) ?></div>
            <div class="pd-stack">
                <?php foreach ($p['stack'] as $s): ?>
                    <span class="pd-chip"><?= htmlspecialchars($s) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- 03 — GALERIJA (tamna sekcija: mockup-i "svetle" na tamnoj podlozi) -->
<section class="section pf-section" id="gallery" aria-labelledby="gallery-title">
    <div class="pf-aurora" aria-hidden="true"></div>
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>03</strong><span class="line"></span><span><?= htmlspecialchars($t['pd_gallery_eyebrow']) ?></span></div>
            <h2 class="s-title" id="gallery-title"><?= htmlspecialchars($t['pd_gallery_title']) ?></h2>
        </div>

        <div class="pd-gallery reveal" id="pdGallery">
            <?php foreach ($p['gallery'] as $g): ?>
            <figure>
                <button type="button" class="pd-shot-btn js-lb"
                        data-src="<?= $base ?>/<?= $g['src'] ?>"
                        data-cap="<?= htmlspecialchars($g['caption']) ?>"
                        aria-label="<?= htmlspecialchars($g['caption']) ?>">
                    <img src="<?= $base ?>/<?= $g['src'] ?>"
                         alt="<?= htmlspecialchars($g['caption']) ?>"
                         width="1200" height="750" loading="lazy" decoding="async">
                    <span class="zoom"><?= vug_icon('arrows-angle-expand') ?></span>
                </button>
                <figcaption><?= htmlspecialchars($g['caption']) ?></figcaption>
            </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- SLEDEĆI KORAK — jedna svetla sekcija zatvara stranicu (kontakt + susedni projekti) -->
<section class="section section--cream" id="next" aria-labelledby="pd-cta-title">
    <div class="container">
        <?php require __DIR__ . '/project-close.php'; ?>
    </div>
</section>
