<?php
$db = getDB();
$settings = [];
$stmt = $db->query("SELECT * FROM settings ORDER BY setting_key ASC");
foreach ($stmt->fetchAll() as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>
<div class="top-bar">
    <h1>Site Settings</h1>
</div>

<?php if (isset($_GET['saved'])): ?>
    <div class="alert alert-success">Settings saved successfully.</div>
<?php endif; ?>

<div class="card">
    <form method="POST" action="/admin/?page=settings&action=save">
        <div class="form-row">
            <div class="form-group">
                <label>Site Name</label>
                <input type="text" name="settings[site_name]" value="<?= htmlspecialchars($settings['site_name'] ?? 'Locksmiths.ie') ?>">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="settings[site_phone]" value="<?= htmlspecialchars($settings['site_phone'] ?? '') ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="settings[site_email]" value="<?= htmlspecialchars($settings['site_email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="settings[site_address]" value="<?= htmlspecialchars($settings['site_address'] ?? '') ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>WhatsApp Number</label>
                <input type="text" name="settings[whatsapp]" value="<?= htmlspecialchars($settings['whatsapp'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Google Reviews URL</label>
                <input type="text" name="settings[google_reviews_url]" value="<?= htmlspecialchars($settings['google_reviews_url'] ?? '') ?>">
            </div>
        </div>

        <h3 style="margin: 20px 0 10px;">Admin Password</h3>
        <div class="form-group">
            <label>New Password (leave blank to keep current)</label>
            <input type="password" name="settings[admin_password_hash]" placeholder="Enter new password to change...">
            <small style="color:#888">Will be hashed automatically on save.</small>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
