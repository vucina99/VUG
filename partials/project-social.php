<?php
/**
 * VUG — šablon stranice projekta za VOĐENJE DRUŠTVENIH MREŽA (cat 'social').
 * Uključuje ga projekat.php preko vug_project_template().
 *
 * Priča ovog šablona nije proizvod, nego kanal: profil i mreža objava umesto
 * "sajta na ekranu", rubrike u formatu 9:16 (kako sadržaj i nastaje), kalendar
 * objavljivanja i kanali/alati. Zato ovde nema .pdw-* komponenti.
 *
 * Ritam sekcija je isti kao na početnoj (tamno -> svetlo -> tamno), a poslednja
 * sekcija je UVEK svetla jer je futer već taman.
 *
 * Očekuje iz projekat.php: $p, $t, $lang, $base, $home, $pf_url, $sib,
 * $contact_href, $phone_clean.
 */

$soc      = $p['social'] ?? [];
$channels = $soc['channels'] ?? [];
$handle   = $soc['handle'] ?? '';
$pillars  = $p['pillars'] ?? [];
$reels    = $p['reels'] ?? [];
$rhythm   = $p['rhythm'] ?? [];

// Inicijali za avatar profila (bez slike — brend nema logotip u portfoliju).
$words    = preg_split('/\s+/', trim($p['title'])) ?: [];
$initials = mb_strtoupper(mb_substr($words[0] ?? 'V', 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : ''), 'UTF-8');
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
                <?= vug_icon('instagram') ?>
                <?= htmlspecialchars($p['cat_label']) ?>
            </span>
            <?php foreach ($channels as $ch): ?>
            <span class="pds-chan-chip"><?= vug_icon($ch[0]) ?><?= htmlspecialchars($ch[1]) ?></span>
            <?php endforeach; ?>
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
                <?= htmlspecialchars($t['pds_visit']) ?>
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

<!-- PROFIL + MREŽA OBJAVA (umesto jednog "ekrana" kao na web projektima) -->
<section class="pd-stage pds-stage" aria-label="<?= htmlspecialchars($p['title'] . ' — ' . $t['pds_grid_label']) ?>">
    <div class="container">
        <div class="pd-stage-glow" aria-hidden="true"></div>

        <div class="pds-stage-grid">
            <div class="pds-profile reveal">
                <div class="pds-profile-head">
                    <span class="pds-avatar" aria-hidden="true"><?= htmlspecialchars($initials) ?></span>
                    <div>
                        <?php if ($handle !== ''): ?>
                        <div class="pds-handle"><?= htmlspecialchars($handle) ?></div>
                        <?php endif; ?>
                        <div class="pds-name"><?= htmlspecialchars($p['client']) ?></div>
                    </div>
                </div>

                <p class="pds-bio"><?= htmlspecialchars($p['sector']) ?> · <?= htmlspecialchars($p['duration']) ?></p>

                <?php if ($channels): ?>
                <div class="pd-meta-label"><?= htmlspecialchars($t['pds_channels_label']) ?></div>
                <ul class="pds-chan">
                    <?php foreach ($channels as $ch): ?>
                    <li class="pds-chan-row">
                        <span class="ic"><?= vug_icon($ch[0]) ?></span>
                        <span class="nm"><?= htmlspecialchars($ch[1]) ?></span>
                        <span class="hd"><?= htmlspecialchars($ch[2] ?? '') ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

            <figure class="pds-feed js-tilt">
                <img src="<?= $base ?>/<?= $p['grid_art'] ?>"
                     alt="<?= htmlspecialchars($p['title'] . ' — ' . $t['pds_grid_label']) ?>"
                     width="900" height="900" decoding="async" fetchpriority="high">
                <figcaption><?= vug_icon('grid') ?><?= htmlspecialchars($t['pds_grid_label']) ?></figcaption>
            </figure>
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

<!-- 01 — PRIČA: rezime + zadatak / pristup / rezultat -->
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

            <div class="pds-blocks stagger">
                <?php foreach ([
                    [$t['pd_challenge'], $p['challenge']],
                    [$t['pd_approach'],  $p['approach']],
                    [$t['pd_result'],    $p['result']],
                ] as $blk): ?>
                <div class="pds-block">
                    <h3 class="pds-block-title"><?= htmlspecialchars($blk[0]) ?></h3>
                    <p><?= htmlspecialchars($blk[1]) ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- 02 — ŠTA RADIMO NA PROFILU -->
<section class="section section--light" id="delivered" aria-labelledby="delivered-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>02</strong><span class="line"></span><span><?= htmlspecialchars($t['pd_highlights_eyebrow']) ?></span></div>
            <h2 class="s-title" id="delivered-title"><?= htmlspecialchars($t['pds_work_title']) ?></h2>
        </div>

        <div class="pd-hl stagger">
            <?php foreach ($p['highlights'] as $h): ?>
            <div class="pd-hl-card">
                <div class="pd-hl-ic"><?= vug_icon($h[0]) ?></div>
                <h3 class="pd-hl-title"><?= htmlspecialchars($h[1]) ?></h3>
                <p class="pd-hl-desc"><?= htmlspecialchars($h[2]) ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Alati: kompaktan red na dnu iste sekcije, ne svoja sekcija (izbor
             korisnika 2026-08-05). Kanali se NE ponavljaju ovde — stoje sa
             nalozima u kartici profila u herou. -->
        <div class="pd-tech reveal">
            <div class="pd-meta-label"><?= htmlspecialchars($t['pds_tools_label']) ?></div>
            <div class="pd-stack">
                <?php foreach ($p['stack'] as $s): ?>
                    <span class="pd-chip"><?= htmlspecialchars($s) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- 03 — RUBRIKE (9:16, format u kome sadržaj nastaje) + profil/identitet/izveštaji -->
<section class="section pf-section" id="content" aria-labelledby="content-title">
    <div class="pf-aurora" aria-hidden="true"></div>
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong>03</strong><span class="line"></span><span><?= htmlspecialchars($t['pds_pillars_eyebrow']) ?></span></div>
            <h2 class="s-title" id="content-title"><?= htmlspecialchars($t['pds_pillars_title']) ?></h2>
            <p class="s-lead"><?= htmlspecialchars($t['pds_pillars_lead']) ?></p>
        </div>

        <div class="pds-pillars stagger">
            <?php foreach ($reels as $i => $r): ?>
            <article class="pds-pillar">
                <button type="button" class="pds-pillar-media js-lb"
                        data-src="<?= $base ?>/<?= $r['src'] ?>"
                        data-cap="<?= htmlspecialchars($r['label']) ?>"
                        aria-label="<?= htmlspecialchars($r['label']) ?>">
                    <img src="<?= $base ?>/<?= $r['src'] ?>"
                         alt="<?= htmlspecialchars($p['title'] . ' — ' . $r['label']) ?>"
                         width="720" height="1280" loading="lazy" decoding="async">
                    <span class="play"><?= vug_icon('play-fill') ?></span>
                </button>
                <div class="pds-pillar-body">
                    <span class="pds-pillar-n"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <h3 class="pds-pillar-title"><?= htmlspecialchars($r['label']) ?></h3>
                    <p class="pds-pillar-desc"><?= htmlspecialchars($r['desc']) ?></p>
                    <?php if (!empty($r['tags'])): ?>
                    <div class="pd-meta-label"><?= htmlspecialchars($t['pds_formats_label']) ?></div>
                    <div class="pds-pillar-tags">
                        <?php foreach ($r['tags'] as $tg): ?>
                            <span><?= htmlspecialchars($tg) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <div class="pds-shots-head reveal">
            <span class="pd-meta-label"><?= htmlspecialchars($t['pds_reports_label']) ?></span>
            <span class="line" aria-hidden="true"></span>
        </div>

        <div class="pds-shots reveal" id="pdGallery">
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

<!-- 04 — KALENDAR OBJAVLJIVANJA -->
<?php if ($rhythm): ?>
<section class="section section--cream" id="rhythm" aria-labelledby="rhythm-title">
    <div class="container">
        <div class="s-head reveal" style="margin-bottom: clamp(34px, 4vw, 56px);">
            <div class="s-index"><strong>04</strong><span class="line"></span><span><?= htmlspecialchars($t['pds_rhythm_eyebrow']) ?></span></div>
            <h2 class="s-title" id="rhythm-title" style="font-size: clamp(30px, 3.8vw, 50px);"><?= htmlspecialchars($t['pds_rhythm_title']) ?></h2>
            <p class="s-lead"><?= htmlspecialchars($t['pds_rhythm_lead']) ?></p>
        </div>

        <ol class="pds-rhythm stagger">
            <?php foreach ($rhythm as $i => $slot): ?>
            <li class="pds-slot">
                <span class="pds-slot-i"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                <span class="pds-slot-day"><?= htmlspecialchars($slot[0]) ?></span>
                <span class="pds-slot-what"><?= htmlspecialchars($slot[1]) ?></span>
            </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>
<?php endif; ?>

<!-- SLEDEĆI KORAK — jedna svetla sekcija zatvara stranicu (kontakt + susedni projekti) -->
<section class="section section--light" id="next" aria-labelledby="pd-cta-title">
    <div class="container">
        <?php require __DIR__ . '/project-close.php'; ?>
    </div>
</section>
