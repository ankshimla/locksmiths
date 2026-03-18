<?php require __DIR__ . '/../partials/hero.php'; ?>

<!-- Trust Badges Section -->
<section class="trust-badges">
    <div class="container">
        <div class="badges-grid">
            <div class="badge-item animate-on-scroll">
                <span class="badge-icon">&#128274;</span>
                <strong>20+ Years</strong>
                <span>Experience</span>
            </div>
            <div class="badge-item animate-on-scroll">
                <span class="badge-icon">&#9200;</span>
                <strong>24/7</strong>
                <span>Emergency Service</span>
            </div>
            <div class="badge-item animate-on-scroll">
                <span class="badge-icon">&#11088;</span>
                <strong>Highest Rated</strong>
                <span>in Ireland</span>
            </div>
            <div class="badge-item animate-on-scroll">
                <span class="badge-icon">&#128666;</span>
                <strong>30 Min</strong>
                <span>Response Time</span>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section services-section" id="services">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <h2>Our Locksmith Services</h2>
            <p>Comprehensive security solutions for homes, businesses, and vehicles across Dublin and Ireland</p>
        </div>
        <?php require __DIR__ . '/../partials/services-grid.php'; ?>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section why-choose-us">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <h2>Why Choose Locksmiths.ie?</h2>
            <p>Ireland's most trusted locksmith company with a proven track record</p>
        </div>
        <div class="features-grid">
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">&#128176;</div>
                <h3>No Hidden Fees</h3>
                <p>Transparent pricing with free quotes. We agree the price before we start any work — no surprises, no call-out charges on most jobs.</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">&#128272;</div>
                <h3>Certified Professionals</h3>
                <p>All our locksmiths are fully trained, Garda vetted, and insured. We hold industry certifications and follow the highest standards of workmanship.</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">&#9889;</div>
                <h3>Rapid Response</h3>
                <p>Locked out? Our emergency team arrives within 30 minutes across Dublin. We operate 24 hours a day, 7 days a week, 365 days a year.</p>
            </div>
            <div class="feature-card animate-on-scroll">
                <div class="feature-icon">&#128736;</div>
                <h3>Latest Technology</h3>
                <p>We invest in cutting-edge equipment for transponder key programming, smart lock installation, and advanced security systems.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<?php require __DIR__ . '/../partials/cta-banner.php'; ?>

<!-- Location Pages -->
<section class="section locations-section" id="locations">
    <div class="container">
        <div class="section-header animate-on-scroll">
            <h2>Locksmith Services Across Dublin</h2>
            <p>We provide fast, reliable locksmith services in every area of Dublin and surrounding counties</p>
        </div>
        <?php require __DIR__ . '/../partials/locations-grid.php'; ?>
    </div>
</section>

<!-- Reviews Section -->
<section class="section reviews-section" id="reviews">
    <div class="container">
        <?php require __DIR__ . '/../partials/reviews.php'; ?>
    </div>
</section>

<!-- FAQ Section -->
<section class="section faq-section" id="faqs">
    <div class="container">
        <?php require __DIR__ . '/../partials/faq.php'; ?>
    </div>
</section>

<!-- Final CTA -->
<section class="section cta-final">
    <div class="container text-center">
        <h2 class="animate-on-scroll">Ready to Secure Your Property?</h2>
        <p class="animate-on-scroll">Get a free, no-obligation quote from Ireland's highest-rated locksmith service.</p>
        <div class="cta-buttons animate-on-scroll">
            <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call btn-lg">&#128222; Call Now</a>
            <a href="#quote-form" class="btn btn-primary btn-lg">Get Free Quote</a>
        </div>
    </div>
</section>
