<footer class="site-footer" role="contentinfo">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">

                <!-- Column 1: About -->
                <div class="footer-col footer-col--about">
                    <a href="/" class="footer-logo" aria-label="Locksmiths.ie – Home">
                        <span class="logo-icon" aria-hidden="true">&#128273;</span>
                        <span class="logo-text">Locksmiths<span class="logo-dot">.ie</span></span>
                    </a>
                    <p class="footer-about-text">
                        Ireland's most trusted locksmith service. Available 24/7 across Dublin
                        and all of Ireland for emergency lockouts, lock changes, auto locksmith
                        services and more.
                    </p>
                    <ul class="footer-contact-list" role="list">
                        <li>
                            <a href="<?= SITE_PHONE_LINK ?>" class="footer-contact-link">
                                <span aria-hidden="true">&#128222;</span>
                                <?= htmlspecialchars(SITE_PHONE) ?>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:<?= htmlspecialchars(SITE_EMAIL) ?>" class="footer-contact-link">
                                <span aria-hidden="true">&#9993;</span>
                                <?= htmlspecialchars(SITE_EMAIL) ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 2: Our Services -->
                <nav class="footer-col footer-col--services" aria-label="Footer services navigation">
                    <h3 class="footer-heading">Our Services</h3>
                    <ul class="footer-nav-list" role="list">
                        <li><a href="/emergency-locksmiths" class="footer-nav-link">Emergency Locksmith</a></li>
                        <li><a href="/auto-locksmiths" class="footer-nav-link">Auto Locksmith</a></li>
                        <li><a href="/locksmiths" class="footer-nav-link">Lock Change &amp; Repair</a></li>
                        <li><a href="/master-key-systems" class="footer-nav-link">Master Key Systems</a></li>
                        <li><a href="/transponder-keys-ireland" class="footer-nav-link">Transponder Keys</a></li>
                        <li><a href="/cctv-installation" class="footer-nav-link">CCTV Installation</a></li>
                        <li><a href="/access-control-systems" class="footer-nav-link">Access Control</a></li>
                        <li><a href="/safes-locksmiths" class="footer-nav-link">Safe Opening</a></li>
                        <li><a href="/car-keys-dublin" class="footer-nav-link">Car Keys Dublin</a></li>
                        <li><a href="/slam-locks-vans" class="footer-nav-link">Slam Locks for Vans</a></li>
                        <li><a href="/emergency-callout" class="footer-nav-link">Emergency Callout</a></li>
                    </ul>
                </nav>

                <!-- Column 3: Service Areas -->
                <nav class="footer-col footer-col--locations" aria-label="Footer locations navigation">
                    <h3 class="footer-heading">Service Areas</h3>
                    <ul class="footer-nav-list" role="list">
                        <li><a href="/locksmiths-dublin" class="footer-nav-link">Dublin</a></li>
                        <li><a href="/locksmiths-swords" class="footer-nav-link">Swords</a></li>
                        <li><a href="/locksmiths-lucan" class="footer-nav-link">Lucan</a></li>
                        <li><a href="/locksmiths-blanchardstown" class="footer-nav-link">Blanchardstown</a></li>
                        <li><a href="/locksmiths-tallaght" class="footer-nav-link">Tallaght</a></li>
                        <li><a href="/locksmiths-dundrum" class="footer-nav-link">Dundrum</a></li>
                        <li><a href="/locksmiths-dun-laoghaire" class="footer-nav-link">Dun Laoghaire</a></li>
                        <li><a href="/locksmiths-rathmines" class="footer-nav-link">Rathmines</a></li>
                    </ul>
                </nav>

                <!-- Column 4: Contact Info -->
                <address class="footer-col footer-col--contact">
                    <h3 class="footer-heading">Contact Info</h3>
                    <ul class="footer-contact-details" role="list">
                        <li class="footer-contact-item">
                            <span class="footer-contact-icon" aria-hidden="true">&#128205;</span>
                            <span><?= htmlspecialchars(SITE_ADDRESS) ?></span>
                        </li>
                        <li class="footer-contact-item">
                            <span class="footer-contact-icon" aria-hidden="true">&#128222;</span>
                            <a href="<?= SITE_PHONE_LINK ?>" class="footer-contact-link">
                                <?= htmlspecialchars(SITE_PHONE) ?>
                            </a>
                        </li>
                        <li class="footer-contact-item">
                            <span class="footer-contact-icon" aria-hidden="true">&#9993;</span>
                            <a href="mailto:<?= htmlspecialchars(SITE_EMAIL) ?>" class="footer-contact-link">
                                <?= htmlspecialchars(SITE_EMAIL) ?>
                            </a>
                        </li>
                        <li class="footer-contact-item footer-hours">
                            <span class="footer-contact-icon" aria-hidden="true">&#128336;</span>
                            <span>
                                <strong>24/7 Emergency Service</strong><br>
                                Always available, day or night
                            </span>
                        </li>
                    </ul>
                </address>

            </div><!-- /.footer-grid -->
        </div><!-- /.container -->
    </div><!-- /.footer-main -->

    <!-- Footer bottom bar -->
    <div class="footer-bottom">
        <div class="container footer-bottom__inner">
            <p class="footer-copyright">
                &copy; 2025 <?= htmlspecialchars(SITE_NAME) ?>. All rights reserved.
            </p>
            <nav class="footer-legal-nav" aria-label="Legal navigation">
                <a href="/privacy-policy" class="footer-legal-link">Privacy Policy</a>
                <span aria-hidden="true"> &middot; </span>
                <a href="/terms" class="footer-legal-link">Terms &amp; Conditions</a>
            </nav>
        </div>
    </div><!-- /.footer-bottom -->
</footer>
