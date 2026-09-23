<?php
/**
 * Kartica projekta — deljena između sekcije #projects na početnoj i
 * stranice /projekti. Akcentne boje projekta idu kroz inline --a1/--a2,
 * pa CSS (.pf-card) ne mora ništa da zna o pojedinačnom projektu.
 *
 * Zahteva (definisati PRE require-a):
 *   $p     — projekat iz vug_projects()
 *   $base  — bazna putanja bez / na kraju
 *   $lang  — 'sr' | 'en'
 *   $t     — jezički niz
 *
 * Opciono:
 *   $lazy  — lazy-load slike  [default true]
 *
 * Sve kartice su ISTE veličine (.pf-grid: 2 kolone + grid-auto-rows:1fr),
 * pa kartica ne prima nikakvu širinu.
 */
$lazy = $lazy ?? true;
$href = vug_project_url($base, $lang, $p['slug']);
?>
<a class="pf-card js-pf-card"
   href="<?= htmlspecialchars($href) ?>"
   data-cat="<?= htmlspecialchars($p['cat']) ?>"
   style="--a1: <?= htmlspecialchars($p['a1']) ?>; --a2: <?= htmlspecialchars($p['a2']) ?>;"
   aria-label="<?= htmlspecialchars($p['title'] . ' — ' . $t['projects_view']) ?>">
    <div class="pf-media">
        <img src="<?= $base ?>/<?= $p['cover'] ?>"
             alt="<?= htmlspecialchars($p['title'] . ' — ' . $p['cat_label']) ?>"
             width="1200" height="750"
             <?= $lazy ? 'loading="lazy" ' : '' ?>decoding="async">
        <div class="pf-badges">
            <span class="pf-cat"><?= htmlspecialchars($p['cat_label']) ?></span>
            <span class="pf-year"><?= htmlspecialchars($p['year']) ?></span>
        </div>
        <span class="pf-open"><?= htmlspecialchars($t['projects_view']) ?> <?= vug_icon('arrow-up-right') ?></span>
    </div>
    <div class="pf-body">
        <span class="pf-client"><?= htmlspecialchars($p['client']) ?></span>
        <h3 class="pf-title"><?= htmlspecialchars($p['title']) ?></h3>
        <p class="pf-tagline"><?= htmlspecialchars($p['tagline']) ?></p>
        <div class="pf-tags">
            <?php foreach (array_slice($p['services'], 0, 3) as $svc): ?>
                <span class="pf-tag"><?= htmlspecialchars($svc) ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</a>
