<section class="hero" aria-label="Hero section">
    <div class="hero__bg-overlay" aria-hidden="true"></div>

    <div class="container hero__container">

        <!-- Left column: text + CTAs -->
        <div class="hero__content">

            <?php if (!empty($breadcrumbs)): ?>
                <?php require __DIR__ . '/breadcrumbs.php'; ?>
            <?php endif; ?>

            <h1 class="hero__title">
                <?= htmlspecialchars($heroTitle ?? 'Expert Locksmith Services in Dublin &amp; Ireland') ?>
            </h1>

            <?php if (!empty($heroSubtitle)): ?>
                <p class="hero__subtitle">
                    <?= htmlspecialchars($heroSubtitle) ?>
                </p>
            <?php endif; ?>

            <!-- Trust badges -->
            <ul class="trust-badges" role="list" aria-label="Trust indicators">
                <li class="trust-badge">
                    <span class="trust-badge__icon" aria-hidden="true">&#9733;</span>
                    <span class="trust-badge__text">
                        <strong>20+ Years</strong>
                        <span>Experience</span>
                    </span>
                </li>
                <li class="trust-badge">
                    <span class="trust-badge__icon" aria-hidden="true">&#128336;</span>
                    <span class="trust-badge__text">
                        <strong>24/7</strong>
                        <span>Available</span>
                    </span>
                </li>
                <li class="trust-badge">
                    <span class="trust-badge__icon" aria-hidden="true">&#127941;</span>
                    <span class="trust-badge__text">
                        <strong>Highest Rated</strong>
                        <span>4.9 Stars</span>
                    </span>
                </li>
                <li class="trust-badge">
                    <span class="trust-badge__icon" aria-hidden="true">&#128663;</span>
                    <span class="trust-badge__text">
                        <strong>30 Min</strong>
                        <span>Response</span>
                    </span>
                </li>
            </ul>

            <!-- CTA buttons -->
            <div class="hero__cta-group">
                <a href="<?= SITE_PHONE_LINK ?>" class="btn btn--green btn--lg hero__cta-call">
                    <span aria-hidden="true">&#128222;</span>
                    Call Now – <?= htmlspecialchars(SITE_PHONE) ?>
                </a>
                <a href="#quote-form" class="btn btn--gold btn--lg hero__cta-quote">
                    Get a Free Quote
                </a>
            </div>

        </div><!-- /.hero__content -->

        <!-- Right column: quote form -->
        <div class="hero__form-col">
            <?php require __DIR__ . '/quote-form.php'; ?>
        </div>

    </div><!-- /.hero__container -->
</section>
