<?php
/**
 * Deljena KONTAKT sekcija (info kartice + forma) — JEDAN izvor za sve stranice.
 * Ranije je markup stajao samo u index.php; landing stranice su ga tražile, pa je
 * izdvojen ovde da se ne kodira dva puta. Ubaciti sa:
 *     require __DIR__ . '/partials/contact.php';
 *
 * Zahteva (definisati PRE require-a):
 *   $t, $lang, $base, $phone_intl
 *
 * Opciono:
 *   $contact_num  — broj sekcije u `s-index` ('07' na početnoj)   [default '07']
 *
 * NAPOMENA: `$RECAPTCHA_SITE_KEY` se definiše OVDE (javni ključ, sme u HTML).
 * Tajni ključ ostaje u php/contact.php. Ostavi prazno da isključiš proveru
 * (npr. na lokalu bez ključeva). Ne prepisivati ga po stranicama.
 */
$RECAPTCHA_SITE_KEY = $RECAPTCHA_SITE_KEY ?? '6Lfp810tAAAAAMESVTJshdNBip8Vva0aF2IoGWh4';
$contact_num        = $contact_num        ?? '07';
$is_sr              = (($lang ?? 'sr') === 'sr');
?>
<!-- KONTAKT — info kartice + forma (partials/contact.php) -->
<section class="section section--light" id="contact" aria-labelledby="contact-title">
    <div class="container">
        <div class="s-head reveal">
            <div class="s-index"><strong><?= htmlspecialchars($contact_num) ?></strong><span class="line"></span><span><?= $t['contact_eyebrow'] ?></span></div>
            <h2 class="s-title" id="contact-title"><?= $t['contact_title'] ?></h2>
            <p class="s-lead"><?= $t['contact_subtitle'] ?></p>
        </div>

        <div class="contact-classic">
            <div class="contact-info-block reveal">
                <ul class="info-cards">
                    <li>
                        <div class="info-ic"><?= vug_icon('envelope-fill') ?></div>
                        <div>
                            <span class="info-label">Email</span>
                            <a href="<?= vug_email_obf('mailto:' . $t['contact_info_email']) ?>"><?= vug_email_obf($t['contact_info_email']) ?></a>
                        </div>
                    </li>
                    <li>
                        <div class="info-ic"><?= vug_icon('telephone-fill') ?></div>
                        <div>
                            <span class="info-label"><?= $is_sr ? 'Telefon' : 'Phone' ?></span>
                            <a href="tel:<?= $phone_intl ?>"><?= $t['contact_info_phone'] ?></a>
                        </div>
                    </li>
                    <li>
                        <div class="info-ic"><?= vug_icon('geo-alt-fill') ?></div>
                        <div>
                            <span class="info-label"><?= $is_sr ? 'Sedište' : 'HQ' ?></span>
                            <span><?= $t['contact_info_location'] ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="info-ic"><?= vug_icon('clock-fill') ?></div>
                        <div>
                            <span class="info-label"><?= $is_sr ? 'Radno vreme' : 'Hours' ?></span>
                            <span><?= $t['contact_info_hours'] ?></span>
                        </div>
                    </li>
                </ul>

                <div class="socials">
                    <a href="https://www.instagram.com/vugagency" target="_blank" rel="noopener" aria-label="Instagram"><?= vug_icon('instagram') ?></a>
                    <a href="https://www.facebook.com/profile.php?id=61592111037904" target="_blank" rel="noopener" aria-label="Facebook"><?= vug_icon('facebook') ?></a>
                    <a href="https://www.linkedin.com/company/vug-digital-agency/" target="_blank" rel="noopener" aria-label="LinkedIn"><?= vug_icon('linkedin') ?></a>
                </div>
            </div>

            <!-- action je base-aware: forma radi i u podfolderu (lokal) i u rootu. -->
            <form class="contact-form-classic reveal" id="contactForm" action="<?= $base ?>/php/contact.php" method="POST" novalidate data-recaptcha-key="<?= htmlspecialchars($RECAPTCHA_SITE_KEY, ENT_QUOTES, 'UTF-8') ?>" data-recaptcha-action="contact">
                <input type="hidden" name="lang" value="<?= $lang ?>">
                <input type="text" name="website" class="honeypot" tabindex="-1" autocomplete="off" aria-hidden="true">

                <div class="form-row">
                    <label for="name"><?= vug_icon('person') ?> <?= $t['form_name'] ?></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="<?= $t['form_name_ph'] ?>" required minlength="2" maxlength="80">
                    <span class="form-error" data-for="name"></span>
                </div>
                <div class="form-row">
                    <label for="email"><?= vug_icon('envelope') ?> <?= $t['form_email'] ?></label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="<?= $t['form_email_ph'] ?>" required maxlength="120">
                    <span class="form-error" data-for="email"></span>
                </div>
                <div class="form-row">
                    <label for="subject"><?= vug_icon('tag') ?> <?= $t['form_subject'] ?></label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="<?= $t['form_subject_ph'] ?>" required minlength="3" maxlength="120">
                    <span class="form-error" data-for="subject"></span>
                </div>
                <div class="form-row">
                    <label for="message"><?= vug_icon('chat-left-text') ?> <?= $t['form_message'] ?></label>
                    <textarea id="message" name="message" rows="5" class="form-control" placeholder="<?= $t['form_message_ph'] ?>" required minlength="3"></textarea>
                    <div class="form-row-foot">
                        <span class="form-error" data-for="message"></span>
                        <span class="form-counter" data-for="message" aria-live="polite">0 / 3000</span>
                    </div>
                </div>

                <button type="submit" class="btn btn--primary submit-btn" id="submitBtn">
                    <span class="btn-label"><?= vug_icon('send-fill') ?> <?= $t['form_submit'] ?></span>
                </button>

                <div class="form-feedback" id="formFeedback" role="status" aria-live="polite"></div>

                <script type="application/json" id="formMessages">
                {
                    "success": <?= json_encode($t['form_success'], JSON_UNESCAPED_UNICODE) ?>,
                    "error": <?= json_encode($t['form_error'], JSON_UNESCAPED_UNICODE) ?>,
                    "sending": <?= json_encode($t['form_sending'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_name": <?= json_encode($t['form_err_name'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_email": <?= json_encode($t['form_err_email'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_subject": <?= json_encode($t['form_err_subject'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_message": <?= json_encode($t['form_err_message'], JSON_UNESCAPED_UNICODE) ?>,
                    "err_message_max": <?= json_encode($t['form_err_message_max'], JSON_UNESCAPED_UNICODE) ?>
                }
                </script>
            </form>
        </div>
    </div>
</section>
