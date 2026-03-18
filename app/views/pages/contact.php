<?php require __DIR__ . '/../partials/breadcrumbs.php'; ?>

<section class="page-hero contact-hero">
    <div class="container">
        <h1>Contact Locksmiths.ie</h1>
        <p class="hero-intro">Get in touch for a free quote or emergency assistance — we're available 24/7</p>
    </div>
</section>

<section class="section page-content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <div class="contact-info-cards">
                    <div class="contact-card glass-card">
                        <div class="contact-icon">&#128222;</div>
                        <h3>Call Us</h3>
                        <p>For immediate assistance, call our 24/7 line:</p>
                        <a href="<?= SITE_PHONE_LINK ?>" class="contact-detail"><?= SITE_PHONE ?></a>
                    </div>
                    <div class="contact-card glass-card">
                        <div class="contact-icon">&#9993;</div>
                        <h3>Email Us</h3>
                        <p>For non-urgent enquiries:</p>
                        <a href="mailto:<?= SITE_EMAIL ?>" class="contact-detail"><?= SITE_EMAIL ?></a>
                    </div>
                    <div class="contact-card glass-card">
                        <div class="contact-icon">&#128205;</div>
                        <h3>Service Area</h3>
                        <p>We cover all of Dublin and Ireland:</p>
                        <span class="contact-detail"><?= SITE_ADDRESS ?></span>
                    </div>
                    <div class="contact-card glass-card">
                        <div class="contact-icon">&#9200;</div>
                        <h3>Opening Hours</h3>
                        <p>We never close:</p>
                        <span class="contact-detail">24/7, 365 Days a Year</span>
                    </div>
                </div>

                <div class="contact-form-section">
                    <h2>Send Us a Message</h2>
                    <form id="contact-form" data-ajax="true" class="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-name">Your Name *</label>
                                <input type="text" id="contact-name" name="name" required placeholder="John Smith">
                            </div>
                            <div class="form-group">
                                <label for="contact-phone">Phone Number</label>
                                <input type="tel" id="contact-phone" name="phone" placeholder="01 234 5678">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email Address</label>
                            <input type="email" id="contact-email" name="email" placeholder="john@example.com">
                        </div>
                        <div class="form-group">
                            <label for="contact-message">Your Message *</label>
                            <textarea id="contact-message" name="message" rows="5" required placeholder="How can we help you?"></textarea>
                        </div>
                        <div class="form-group" style="display:none">
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                        <div class="form-message"></div>
                    </form>
                </div>
            </div>

            <aside class="content-sidebar">
                <div class="sidebar-cta glass-card">
                    <h3>&#128168; Emergency?</h3>
                    <p>Don't wait — call us now for immediate assistance. Our locksmiths are on standby 24/7.</p>
                    <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call btn-block">Call <?= SITE_PHONE ?></a>
                </div>

                <div class="sidebar-trust glass-card">
                    <h4>Quick Response Guaranteed</h4>
                    <ul>
                        <li>&#10004; Calls answered in seconds</li>
                        <li>&#10004; On-site within 30 minutes</li>
                        <li>&#10004; Free quotes provided</li>
                        <li>&#10004; No obligation</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>
