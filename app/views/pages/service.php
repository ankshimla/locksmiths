<?php require __DIR__ . '/../partials/breadcrumbs.php'; ?>

<section class="page-hero service-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1><?= htmlspecialchars($service['h1'] ?? $service['name']) ?></h1>
            <p class="hero-intro"><?= htmlspecialchars($service['intro']) ?></p>
            <div class="hero-cta">
                <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call">&#128222; Call Now - 24/7</a>
                <a href="#quote-form" class="btn btn-primary">Get Free Quote</a>
            </div>
        </div>
    </div>
</section>

<section class="section page-content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <div class="content-body">
                    <?= $service['content'] ?>
                </div>

                <!-- Service areas for this service -->
                <div class="service-areas animate-on-scroll">
                    <h2><?= htmlspecialchars($service['name']) ?> Service Areas</h2>
                    <p>We provide <?= strtolower(htmlspecialchars($service['name'])) ?> across Dublin and all of Ireland. Click your area below for local service information:</p>
                    <div class="area-links">
                        <?php foreach (array_slice($locations, 0, 20) as $loc): ?>
                            <a href="/locksmiths-<?= htmlspecialchars($loc['slug']) ?>" class="area-link"><?= htmlspecialchars($loc['name']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Related Services -->
                <div class="related-services animate-on-scroll">
                    <h3>Related Services</h3>
                    <div class="related-grid">
                        <?php foreach ($services as $s): ?>
                            <?php if ($s['slug'] !== $service['slug']): ?>
                                <a href="/<?= htmlspecialchars($s['slug']) ?>" class="related-card">
                                    <span class="related-icon"><?= $s['icon'] ?? '&#128274;' ?></span>
                                    <span><?= htmlspecialchars($s['name']) ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- FAQs -->
                <?php if (!empty($faqs)): ?>
                    <div class="page-faqs animate-on-scroll">
                        <?php require __DIR__ . '/../partials/faq.php'; ?>
                    </div>
                <?php endif; ?>

                <!-- Reviews -->
                <?php if (!empty($reviews)): ?>
                    <div class="page-reviews animate-on-scroll">
                        <?php require __DIR__ . '/../partials/reviews.php'; ?>
                    </div>
                <?php endif; ?>
            </div>

            <aside class="content-sidebar">
                <?php require __DIR__ . '/../partials/quote-form.php'; ?>

                <div class="sidebar-cta glass-card">
                    <h3>&#128222; Emergency?</h3>
                    <p>Need urgent help? Our locksmiths arrive within 30 minutes.</p>
                    <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call btn-block">Call <?= SITE_PHONE ?></a>
                </div>

                <div class="sidebar-trust glass-card">
                    <h4>Why Choose Us</h4>
                    <ul>
                        <li>&#10004; 20+ Years Experience</li>
                        <li>&#10004; No Hidden Charges</li>
                        <li>&#10004; 30 Min Response</li>
                        <li>&#10004; Fully Insured</li>
                        <li>&#10004; Garda Vetted</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../partials/cta-banner.php'; ?>
