<div class="quote-form-card glass-card" id="quote-form">
    <h2 class="quote-form__title">Get a Free Quote</h2>
    <p class="quote-form__subtitle">We'll call you back within minutes</p>

    <form
        class="quote-form__form"
        method="POST"
        action="/api/quote"
        data-ajax="true"
        novalidate
        aria-label="Request a free quote"
    >

        <div class="form-group">
            <label for="quote-name" class="form-label">
                Your Name <span class="form-required" aria-label="required">*</span>
            </label>
            <input
                type="text"
                id="quote-name"
                name="name"
                class="form-input"
                placeholder="e.g. John Murphy"
                required
                autocomplete="name"
                aria-required="true"
            >
        </div>

        <div class="form-group">
            <label for="quote-phone" class="form-label">
                Phone Number <span class="form-required" aria-label="required">*</span>
            </label>
            <input
                type="tel"
                id="quote-phone"
                name="phone"
                class="form-input"
                placeholder="e.g. 085 123 4567"
                required
                autocomplete="tel"
                aria-required="true"
            >
        </div>

        <div class="form-group">
            <label for="quote-email" class="form-label">Email Address</label>
            <input
                type="email"
                id="quote-email"
                name="email"
                class="form-input"
                placeholder="you@example.com"
                autocomplete="email"
            >
        </div>

        <div class="form-group">
            <label for="quote-service" class="form-label">Service Required</label>
            <select id="quote-service" name="service" class="form-select">
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
            <label for="quote-location" class="form-label">Your Location</label>
            <select id="quote-location" name="location" class="form-select">
                <option value="" disabled selected>Select your area&hellip;</option>
                <option value="dublin">Dublin City</option>
                <option value="swords">Swords</option>
                <option value="lucan">Lucan</option>
                <option value="blanchardstown">Blanchardstown</option>
                <option value="tallaght">Tallaght</option>
                <option value="dundrum">Dundrum</option>
                <option value="dun-laoghaire">Dun Laoghaire</option>
                <option value="rathmines">Rathmines</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quote-message" class="form-label">Additional Details</label>
            <textarea
                id="quote-message"
                name="message"
                class="form-textarea"
                rows="3"
                placeholder="Briefly describe your situation&hellip;"
            ></textarea>
        </div>

        <button type="submit" class="btn btn--gold btn--full quote-form__submit">
            <span class="btn-text">Request Free Quote</span>
            <span class="btn-loading" aria-hidden="true" hidden>Sending&hellip;</span>
        </button>

    </form>

    <!-- Success / error feedback -->
    <div class="quote-form__message" id="quote-form-message" role="alert" aria-live="polite" hidden></div>

</div><!-- /.quote-form-card -->
