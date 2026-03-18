<?php require __DIR__ . '/../partials/breadcrumbs.php'; ?>

<section class="page-hero brand-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1><?= htmlspecialchars($brand['h1'] ?? $brand['name'] . ' Auto Locksmith') ?></h1>
            <p class="hero-intro"><?= htmlspecialchars($brand['intro']) ?></p>
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
                    <?= $brand['content'] ?>
                </div>

                <!-- Services for this brand -->
                <div class="brand-services animate-on-scroll">
                    <h2>Our <?= htmlspecialchars($brand['name']) ?> Locksmith Services</h2>
                    <div class="brand-services-grid">
                        <div class="brand-service-item">
                            <h3>&#128273; Key Replacement</h3>
                            <p>Complete <?= htmlspecialchars($brand['name']) ?> key cutting and replacement, including spare keys and lost key replacements.</p>
                        </div>
                        <div class="brand-service-item">
                            <h3>&#128225; Transponder Programming</h3>
                            <p>Expert programming of <?= htmlspecialchars($brand['name']) ?> transponder keys and smart keys using dealer-level equipment.</p>
                        </div>
                        <div class="brand-service-item">
                            <h3>&#128274; Emergency Lockout</h3>
                            <p>Locked out of your <?= htmlspecialchars($brand['name']) ?>? We provide damage-free entry within 30 minutes.</p>
                        </div>
                        <div class="brand-service-item">
                            <h3>&#9881; Immobilizer Repair</h3>
                            <p>Diagnosis and repair of <?= htmlspecialchars($brand['name']) ?> immobilizer systems, ECU coding, and key synchronisation.</p>
                        </div>
                    </div>
                </div>

                <!-- Other Brands -->
                <div class="other-brands animate-on-scroll">
                    <h3>Other Car Brands We Service</h3>
                    <div class="area-links">
                        <?php foreach ($brands as $b): ?>
                            <?php if ($b['slug'] !== $brand['slug']): ?>
                                <a href="/auto-locksmith-<?= htmlspecialchars($b['slug']) ?>" class="area-link"><?= htmlspecialchars($b['name']) ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Related Services -->
                <div class="related-services animate-on-scroll">
                    <h3>Related Auto Locksmith Services</h3>
                    <div class="area-links">
                        <a href="/auto-locksmiths" class="area-link">Auto Locksmiths</a>
                        <a href="/car-keys-dublin" class="area-link">Car Keys Dublin</a>
                        <a href="/transponder-keys-ireland" class="area-link">Transponder Keys</a>
                        <a href="/emergency-locksmiths" class="area-link">Emergency Locksmiths</a>
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
                    <h3>&#128222; <?= htmlspecialchars($brand['name']) ?> Key Emergency?</h3>
                    <p>Lost your <?= htmlspecialchars($brand['name']) ?> keys? We can help right now.</p>
                    <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call btn-block">Call <?= SITE_PHONE ?></a>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../partials/cta-banner.php'; ?>
