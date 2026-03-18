<div class="quote-form-card" id="quote-form">
    <h3>Get a Free Quote</h3>
    <p class="form-subtitle">We'll call you back within minutes</p>

    <form
        class="quote-form"
        method="POST"
        action="/api/quote"
        data-ajax="true"
        novalidate
        aria-label="Request a free quote"
    >

        <div class="form-group">
            <label for="quote-name">Your Name *</label>
            <input type="text" id="quote-name" name="name" placeholder="e.g. John Murphy" required autocomplete="name">
        </div>

        <div class="form-group">
            <label for="quote-phone">Phone Number *</label>
            <input type="tel" id="quote-phone" name="phone" placeholder="e.g. 085 123 4567" required autocomplete="tel">
        </div>

        <div class="form-group">
            <label for="quote-email">Email Address</label>
            <input type="email" id="quote-email" name="email" placeholder="you@example.com" autocomplete="email">
        </div>

        <div class="form-group">
            <label for="quote-service">Service Required</label>
            <select id="quote-service" name="service">
                <option value="" disabled selected>Select a service&hellip;</option>
                <option value="emergency-locksmith">Emergency Locksmith</option>
                <option value="auto-locksmith">Auto Locksmith</option>
                <option value="lock-change">Lock Change</option>
                <option value="master-key-system">Master Key System</option>
                <option value="cctv">CCTV Installation</option>
                <option value="access-control">Access Control</option>
                <option value="safe-opening">Safe Opening</option>
                <option value="car-keys">Car Keys</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quote-location">Your Location</label>
            <select id="quote-location" name="location">
                <option value="" disabled selected>Select your area&hellip;</option>
                <option value="dublin">Dublin City</option>
                <option value="swords">Swords</option>
                <option value="lucan">Lucan</option>
                <option value="blanchardstown">Blanchardstown</option>
                <option value="tallaght">Tallaght</option>
                <option value="dundrum">Dundrum</option>
                <option value="dun-laoghaire">Dun Laoghaire</option>
                <option value="rathmines">Rathmines</option>
                <option value="cork">Cork</option>
                <option value="galway">Galway</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quote-message">Additional Details</label>
            <textarea id="quote-message" name="message" rows="3" placeholder="Briefly describe your situation&hellip;"></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-submit">
            Request Free Quote
        </button>

    </form>

    <!-- Success / error feedback -->
    <div class="form-success" id="quote-form-success" role="alert">Thank you! We'll call you back shortly.</div>
    <div class="form-error" id="quote-form-error" role="alert">Something went wrong. Please call us directly.</div>

</div><!-- /.quote-form-card -->
