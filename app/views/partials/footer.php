<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">

            <!-- Column 1: About -->
            <div class="footer-col">
                <a href="/" class="footer-logo" aria-label="Locksmiths.ie – Home">
                    <span style="font-size:1.3rem;" aria-hidden="true">&#128273;</span>
                    <span class="footer-logo-text">Locksmiths<span>.ie</span></span>
                </a>
                <p>
                    Ireland's most trusted locksmith service. Available 24/7 across Dublin
                    and all of Ireland for emergency lockouts, lock changes, auto locksmith
                    services and more.
                </p>
                <div class="social-links">
                    <a href="https://facebook.com/locksmithsie" class="social-link" target="_blank" rel="noopener" aria-label="Facebook">f</a>
                    <a href="https://instagram.com/locksmithsie" class="social-link" target="_blank" rel="noopener" aria-label="Instagram">in</a>
                    <a href="https://twitter.com/locksmithsie" class="social-link" target="_blank" rel="noopener" aria-label="Twitter">X</a>
                </div>
            </div>

            <!-- Column 2: Services -->
            <div class="footer-col">
                <h4>Our Services</h4>
                <div class="footer-links">
                    <a href="/emergency-locksmiths">Emergency Locksmith</a>
                    <a href="/auto-locksmiths">Auto Locksmith</a>
                    <a href="/locksmiths">Lock Change & Repair</a>
                    <a href="/master-key-systems">Master Key Systems</a>
                    <a href="/transponder-keys-ireland">Transponder Keys</a>
                    <a href="/cctv-installation">CCTV Installation</a>
                    <a href="/access-control-systems">Access Control</a>
                    <a href="/safes-locksmiths">Safe Opening</a>
                    <a href="/car-keys-dublin">Car Keys Dublin</a>
                    <a href="/slam-locks-vans">Slam Locks for Vans</a>
                    <a href="/emergency-callout">Emergency Callout</a>
                </div>
            </div>

            <!-- Column 3: Service Areas -->
            <div class="footer-col">
                <h4>Service Areas</h4>
                <div class="footer-links">
                    <a href="/locksmiths-dublin">Dublin</a>
                    <a href="/locksmiths-swords">Swords</a>
                    <a href="/locksmiths-lucan">Lucan</a>
                    <a href="/locksmiths-blanchardstown">Blanchardstown</a>
                    <a href="/locksmiths-tallaght">Tallaght</a>
                    <a href="/locksmiths-dundrum">Dundrum</a>
                    <a href="/locksmiths-dun-laoghaire">Dun Laoghaire</a>
                    <a href="/locksmiths-rathmines">Rathmines</a>
                    <a href="/locksmiths-cork">Cork</a>
                    <a href="/locksmiths-galway">Galway</a>
                </div>
            </div>

            <!-- Column 4: Contact -->
            <div class="footer-col">
                <h4>Contact Info</h4>
                <div class="footer-contact-item">
                    <span>&#128205;</span>
                    <span><?= htmlspecialchars(SITE_ADDRESS) ?></span>
                </div>
                <div class="footer-contact-item">
                    <span>&#128222;</span>
                    <a href="<?= SITE_PHONE_LINK ?>" style="color:inherit;text-decoration:none;">
                        <?= htmlspecialchars(SITE_PHONE) ?>
                    </a>
                </div>
                <div class="footer-contact-item">
                    <span>&#9993;</span>
                    <a href="mailto:<?= htmlspecialchars(SITE_EMAIL) ?>" style="color:inherit;text-decoration:none;">
                        <?= htmlspecialchars(SITE_EMAIL) ?>
                    </a>
                </div>
                <div class="footer-contact-item">
                    <span>&#128336;</span>
                    <span><strong>24/7 Emergency Service</strong><br>Always available</span>
                </div>
            </div>

        </div><!-- /.footer-grid -->
    </div><!-- /.container -->

    <!-- Footer bottom bar -->
    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> <?= htmlspecialchars(SITE_NAME) ?>. All rights reserved.</p>
        <div class="footer-bottom-links">
            <a href="/privacy-policy">Privacy Policy</a>
            <a href="/terms">Terms & Conditions</a>
        </div>
    </div>
</footer>
