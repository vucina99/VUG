<?php
/**
 * VUG - sekcija „Šta kažu klijenti“ (traka recenzija koja se vrti).
 *
 * JEDAN izvor markupa za početnu (index.php, sekcija 04) i landing stranice
 * (landing.php, ključ 'rev' u php/landing-content.php). Tekst recenzija je u
 * lang/*.php (testimonial_N_*), a traku pokreće js/main.js (.t-marquee).
 *
 * Očekuje:
 *   $t          — jezički niz
 *   $tst_num    — broj sekcije ('04' na početnoj, $num() na landing stranici)
 *   $tst_class  — klase sekcije (pozadina se bira prema ritmu stranice;
 *                 .t-card ima i tamnu i svetlu varijantu)
 *
 * Recenzije NAMERNO nisu u JSON-LD-u (self-serving - vidi index.php).
 */
?>
<section class="<?= $tst_class ?>" id="testimonials" aria-labelledby="testimonials-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong><?= $tst_num ?></strong><span class="line"></span><span><?= $t['testimonials_eyebrow'] ?></span></div>
            <h2 class="s-title" id="testimonials-title"><?= $t['testimonials_title'] ?></h2>
            <p class="s-lead"><?= $t['testimonials_subtitle'] ?></p>
        </div>

        <div class="t-marquee reveal">
            <div class="t-marquee-track">
                <?php
                $testimonials = [
                    ['quote' => $t['testimonial_1_quote'], 'name' => $t['testimonial_1_name'], 'role' => $t['testimonial_1_role']],
                    ['quote' => $t['testimonial_2_quote'], 'name' => $t['testimonial_2_name'], 'role' => $t['testimonial_2_role']],
                    ['quote' => $t['testimonial_3_quote'], 'name' => $t['testimonial_3_name'], 'role' => $t['testimonial_3_role']],
                    ['quote' => $t['testimonial_7_quote'], 'name' => $t['testimonial_7_name'], 'role' => $t['testimonial_7_role']],
                    ['quote' => $t['testimonial_5_quote'], 'name' => $t['testimonial_5_name'], 'role' => $t['testimonial_5_role']],
                    ['quote' => $t['testimonial_6_quote'], 'name' => $t['testimonial_6_name'], 'role' => $t['testimonial_6_role']],
                    ['quote' => $t['testimonial_4_quote'], 'name' => $t['testimonial_4_name'], 'role' => $t['testimonial_4_role']],
                    ['quote' => $t['testimonial_8_quote'], 'name' => $t['testimonial_8_name'], 'role' => $t['testimonial_8_role']],
                ];
                // Kartice su u HTML-u samo JEDNOM (2026-10-22). Drugi primerak za
                // beskonačnu petlju pravi js/main.js (aria-hidden klon) - ranije je
                // PHP ispisivao sve dvaput, pa je ~500 reči stajalo duplo u izvoru.
                foreach ($testimonials as $tst):
                    $initials = '';
                    foreach (explode(' ', $tst['name']) as $w) { $initials .= mb_substr($w, 0, 1); }
                    $initials = mb_strtoupper(mb_substr($initials, 0, 2));
                ?>
                <article class="t-card">
                    <div class="t-mark">"</div>
                    <p class="t-quote"><?= $tst['quote'] ?></p>
                    <div class="t-stars" role="img" aria-label="5/5">
                        <?= vug_icon('star-fill') ?><?= vug_icon('star-fill') ?><?= vug_icon('star-fill') ?><?= vug_icon('star-fill') ?><?= vug_icon('star-fill') ?>
                    </div>
                    <div class="t-author">
                        <div class="t-avatar"><?= $initials ?></div>
                        <div>
                            <div class="t-author-name"><?= $tst['name'] ?></div>
                            <div class="t-author-role"><?= $tst['role'] ?></div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
