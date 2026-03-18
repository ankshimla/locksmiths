<?php
$db = getDB();
$serviceCount = $db->query("SELECT COUNT(*) FROM services")->fetchColumn();
$locationCount = $db->query("SELECT COUNT(*) FROM locations")->fetchColumn();
$brandCount = $db->query("SELECT COUNT(*) FROM brands")->fetchColumn();
$reviewCount = $db->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
$faqCount = $db->query("SELECT COUNT(*) FROM faqs")->fetchColumn();
$quoteCount = $db->query("SELECT COUNT(*) FROM quotes")->fetchColumn();
$blogCount = $db->query("SELECT COUNT(*) FROM blog_posts")->fetchColumn();
?>
<div class="top-bar">
    <h1>Dashboard</h1>
    <span>Welcome to Locksmiths.ie CMS</span>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3><?= $serviceCount ?></h3>
        <p>Services</p>
    </div>
    <div class="stat-card">
        <h3><?= $locationCount ?></h3>
        <p>Locations</p>
    </div>
    <div class="stat-card">
        <h3><?= $brandCount ?></h3>
        <p>Car Brands</p>
    </div>
    <div class="stat-card">
        <h3><?= $reviewCount ?></h3>
        <p>Reviews</p>
    </div>
    <div class="stat-card">
        <h3><?= $faqCount ?></h3>
        <p>FAQs</p>
    </div>
    <div class="stat-card">
        <h3><?= $quoteCount ?></h3>
        <p>Leads/Quotes</p>
    </div>
    <div class="stat-card">
        <h3><?= $blogCount ?></h3>
        <p>Blog Posts</p>
    </div>
</div>

<div class="card">
    <h2>Quick Links</h2>
    <p style="margin-top:10px">
        <a href="/admin/?page=services&action=add" class="btn btn-primary">Add Service</a>
        <a href="/admin/?page=locations&action=add" class="btn btn-primary">Add Location</a>
        <a href="/admin/?page=reviews&action=add" class="btn btn-primary">Add Review</a>
        <a href="/admin/?page=faqs&action=add" class="btn btn-primary">Add FAQ</a>
        <a href="/admin/?page=blog&action=add" class="btn btn-primary">Add Blog Post</a>
    </p>
</div>

<?php
$recentQuotes = $db->query("SELECT * FROM quotes ORDER BY created_at DESC LIMIT 5")->fetchAll();
if (!empty($recentQuotes)):
?>
<div class="card">
    <h2>Recent Leads</h2>
    <table class="table" style="margin-top:10px">
        <tr><th>Name</th><th>Phone</th><th>Service</th><th>Location</th><th>Date</th></tr>
        <?php foreach ($recentQuotes as $q): ?>
            <tr>
                <td><?= htmlspecialchars($q['name']) ?></td>
                <td><?= htmlspecialchars($q['phone']) ?></td>
                <td><?= htmlspecialchars($q['service']) ?></td>
                <td><?= htmlspecialchars($q['location']) ?></td>
                <td><?= $q['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>
