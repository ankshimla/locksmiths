<section class="hero" id="hero" aria-label="Hero section">
    <div class="hero-bg" aria-hidden="true"></div>
    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="hero-content">
        <div class="container">
            <div class="hero-inner">

                <!-- Left column: text + CTAs -->
                <div class="hero-text">

                    <div class="hero-badge">
                        &#9733; Ireland's #1 Rated Locksmith
                    </div>

                    <h1>
                        <?= htmlspecialchars($heroTitle ?? 'Expert Locksmith Services in Dublin & Ireland') ?>
                        <span><?= htmlspecialchars($heroSubtitle ?? '24/7 Emergency Response') ?></span>
                    </h1>

                    <p class="hero-subtitle">
                        Trusted by thousands of Irish homes and businesses. Fast, certified, and affordable locksmith services — day or night.
                    </p>

                    <!-- CTA buttons -->
                    <div class="hero-actions">
                        <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call btn-lg">
                            &#128222; Call Now – <?= htmlspecialchars(SITE_PHONE) ?>
                        </a>
                        <a href="#quote-form" class="btn btn-primary btn-lg">
                            Get a Free Quote
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <strong>20+</strong>
                            <span>Years</span>
                        </div>
                        <div class="hero-stat">
                            <strong>4.9&#9733;</strong>
                            <span>Rating</span>
                        </div>
                        <div class="hero-stat">
                            <strong>30min</strong>
                            <span>Response</span>
                        </div>
                        <div class="hero-stat">
                            <strong>24/7</strong>
                            <span>Available</span>
                        </div>
                    </div>

                </div><!-- /.hero-text -->

                <!-- Right column: quote form -->
                <div class="hero-form-wrap">
                    <?php require __DIR__ . '/quote-form.php'; ?>
                </div>

            </div><!-- /.hero-inner -->
        </div><!-- /.container -->
    </div><!-- /.hero-content -->
</section>
