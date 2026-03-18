<section class="cta-banner" aria-label="Emergency locksmith call to action">
    <div class="cta-banner__overlay" aria-hidden="true"></div>
    <div class="container cta-banner__inner">

        <div class="cta-banner__text">
            <h2 class="cta-banner__heading">Need a Locksmith Right Now?</h2>
            <p class="cta-banner__subheading">
                We're available 24/7 across Dublin and all of Ireland
            </p>
        </div>

        <div class="cta-banner__actions">
            <a
                href="<?= SITE_PHONE_LINK ?>"
                class="btn btn--green btn--xl cta-banner__call"
            >
                <span aria-hidden="true">&#128222;</span>
                Call Now – <?= htmlspecialchars(SITE_PHONE) ?>
            </a>
            <a
                href="https://wa.me/<?= ltrim(str_replace([' ', '-', '(', ')'], '', SITE_PHONE_LINK), 'tel:+') ?>"
                class="btn btn--whatsapp btn--xl cta-banner__whatsapp"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Contact us on WhatsApp"
            >
                <span aria-hidden="true">&#128172;</span>
                WhatsApp Us
            </a>
        </div>

    </div><!-- /.cta-banner__inner -->
</section>
