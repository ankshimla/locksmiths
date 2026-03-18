<?php require __DIR__ . '/../partials/breadcrumbs.php'; ?>

<section class="page-hero location-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1><?= htmlspecialchars($location['h1'] ?? 'Locksmiths ' . $location['name']) ?></h1>
            <p class="hero-intro"><?= htmlspecialchars($location['intro']) ?></p>
            <div class="hero-cta">
                <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call">&#128222; Call Now - 24/7</a>
                <a href="#quote-form" class="btn btn-primary">Get Free Quote in <?= htmlspecialchars($location['name']) ?></a>
            </div>
            <div class="hero-badges">
                <span class="hero-badge">&#11088; 4.9/5 Rating</span>
                <span class="hero-badge">&#9200; 30 Min Response</span>
                <span class="hero-badge">&#128274; 24/7 Service</span>
            </div>
        </div>
    </div>
</section>

<section class="section page-content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <div class="content-body">
                    <?= $location['content'] ?>
                </div>

                <!-- Services in this location -->
                <div class="location-services animate-on-scroll">
                    <h2>Our Services in <?= htmlspecialchars($location['name']) ?></h2>
                    <div class="services-list-grid">
                        <?php foreach ($services as $s): ?>
                            <a href="/<?= htmlspecialchars($s['slug']) ?>" class="service-list-card">
                                <span class="service-list-icon"><?= $s['icon'] ?? '&#128274;' ?></span>
                                <div>
                                    <strong><?= htmlspecialchars($s['name']) ?></strong>
                                    <span>in <?= htmlspecialchars($location['name']) ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Nearby Areas -->
                <?php if (!empty($nearby)): ?>
                    <div class="nearby-areas animate-on-scroll">
                        <h2>Locksmith Services Near <?= htmlspecialchars($location['name']) ?></h2>
                        <p>We also serve these nearby areas with fast response times:</p>
                        <div class="area-links">
                            <?php foreach ($nearby as $loc): ?>
                                <a href="/locksmiths-<?= htmlspecialchars($loc['slug']) ?>" class="area-link">
                                    Locksmiths <?= htmlspecialchars($loc['name']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- FAQs -->
                <?php if (!empty($faqs)): ?>
                    <div class="page-faqs animate-on-scroll">
                        <h2>Locksmith FAQs for <?= htmlspecialchars($location['name']) ?></h2>
                        <?php require __DIR__ . '/../partials/faq.php'; ?>
                    </div>
                <?php endif; ?>

                <!-- Reviews -->
                <?php if (!empty($reviews)): ?>
                    <div class="page-reviews animate-on-scroll">
                        <h2>What <?= htmlspecialchars($location['name']) ?> Customers Say</h2>
                        <?php require __DIR__ . '/../partials/reviews.php'; ?>
                    </div>
                <?php endif; ?>
            </div>

            <aside class="content-sidebar">
                <?php require __DIR__ . '/../partials/quote-form.php'; ?>

                <div class="sidebar-cta glass-card">
                    <h3>&#128222; Locked Out in <?= htmlspecialchars($location['name']) ?>?</h3>
                    <p>Our locksmiths are nearby and can reach you within 30 minutes.</p>
                    <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call btn-block">Call <?= SITE_PHONE ?></a>
                </div>

                <div class="sidebar-trust glass-card">
                    <h4>Why Choose Us in <?= htmlspecialchars($location['name']) ?></h4>
                    <ul>
                        <li>&#10004; Local Locksmiths On Call</li>
                        <li>&#10004; 20+ Years Experience</li>
                        <li>&#10004; No Call-Out Fee</li>
                        <li>&#10004; 30 Min Response</li>
                        <li>&#10004; Fully Insured & Vetted</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../partials/cta-banner.php'; ?>
