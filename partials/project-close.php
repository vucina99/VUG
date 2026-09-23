<?php
/**
 * VUG — zatvaranje stranice projekta: JEDNA svetla sekcija u dva stupca.
 * Levo poziv na kontakt, desno prethodni/sledeći projekat kao kompaktni redovi.
 * Deljeno između oba šablona (project-web.php i project-social.php).
 *
 * Zašto tako (izbor korisnika 2026-08-05, „ovaj deo mi se nikako ne svidja“):
 *   - kraj stranice se raspadao na TRI bloka (tehnologije, susedni projekti, CTA)
 *     -> tehnologije su spuštene u sekciju „Isporučeno“, a ostalo je jedan blok;
 *   - kartice susednih projekata sa trakom slike su odbačene -> tekstualni redovi;
 *   - naslov „Projekti —“ je uklonjen (dupliralo se sa eyebrow-om „Drugi projekti“).
 * Nema outer kartice ni senke — samo linije, kao `.pf-areas` i `.pdw-feat`.
 * Iznad futera ne sme tamna sekcija, pa je blok uvek u `--light`/`--cream`.
 *
 * Očekuje: $p, $t, $lang, $base, $sib, $pf_url, $contact_href, $phone_clean.
 */
?>
<div class="pd-close">
    <div class="pd-close-cta reveal">
        <span class="pd-cta-eyebrow">
            <span class="bullet">×</span>
            <?= htmlspecialchars($t['cta_eyebrow']) ?>
        </span>
        <h2 class="pd-cta-title" id="pd-cta-title">
            <?= htmlspecialchars($t['pd_cta_title_1']) ?>
            <em><?= htmlspecialchars($t['pd_cta_title_2']) ?></em>
        </h2>
        <p class="pd-cta-lead"><?= htmlspecialchars($t['cta_subtitle']) ?></p>

        <div class="pd-cta-actions">
            <a href="<?= $contact_href ?>" class="btn btn--primary is-magnetic">
                <?= htmlspecialchars($t['cta_primary']) ?>
                <?= vug_icon('arrow-up-right') ?>
            </a>
            <a href="tel:<?= $phone_clean ?>" class="btn btn--ghost">
                <?= vug_icon('telephone-fill') ?>
                <?= htmlspecialchars($t['contact_info_phone']) ?>
            </a>
        </div>

        <div class="pd-cta-meta">
            <span class="pulse"></span>
            <?= htmlspecialchars($t['pd_cta_note']) ?>
        </div>
    </div>

    <div class="pd-close-nav reveal">
        <div class="pd-meta-label"><?= htmlspecialchars($t['pd_nav_eyebrow']) ?></div>

        <div class="pd-next-list">
            <?php foreach ([['prev', 'pd_prev', 'arrow-left'], ['next', 'pd_next', 'arrow-right']] as $dir):
                $q = $sib[$dir[0]] ?? null;
                if (!$q) continue; ?>
            <a class="pd-next pd-next--<?= $dir[0] ?>" href="<?= vug_project_url($base, $lang, $q['slug']) ?>">
                <span>
                    <span class="pd-next-dir"><?= vug_icon($dir[2]) ?><?= htmlspecialchars($t[$dir[1]]) ?></span>
                    <span class="pd-next-title"><?= htmlspecialchars($q['title']) ?></span>
                    <span class="pd-next-cat"><?= htmlspecialchars($q['cat_label']) ?></span>
                </span>
                <span class="pd-next-go" aria-hidden="true"><?= vug_icon($dir[2]) ?></span>
            </a>
            <?php endforeach; ?>
        </div>

        <a href="<?= $pf_url ?>" class="pd-close-all">
            <?= htmlspecialchars($t['projects_cta_all']) ?>
            <?= vug_icon('arrow-right') ?>
        </a>
    </div>
</div>
