<?php
/**
 * Sticky bottom CTA bar – visible on mobile only.
 * Controlled via CSS: display:none on desktop, flex on mobile.
 */
?>
<div class="sticky-cta" role="complementary" aria-label="Quick contact actions">

    <a
        href="<?= SITE_PHONE_LINK ?>"
        class="sticky-cta__btn sticky-cta__btn--call"
        aria-label="Call us now on <?= htmlspecialchars(SITE_PHONE) ?>"
    >
        <span class="sticky-cta__icon" aria-hidden="true">&#128222;</span>
        <span class="sticky-cta__label">Call Now</span>
    </a>

    <a
        href="https://wa.me/<?= ltrim(str_replace([' ', '-', '(', ')'], '', SITE_PHONE_LINK), 'tel:+') ?>"
        class="sticky-cta__btn sticky-cta__btn--whatsapp"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Contact us on WhatsApp"
    >
        <span class="sticky-cta__icon" aria-hidden="true">&#128172;</span>
        <span class="sticky-cta__label">WhatsApp</span>
    </a>

</div><!-- /.sticky-cta -->
