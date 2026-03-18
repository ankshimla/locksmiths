<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Locksmiths.ie CMS</title>
    <meta name="robots" content="noindex, nofollow">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, sans-serif; background: #f5f6fa; color: #333; }
        .admin-wrap { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #1a2332; color: #fff; padding: 20px 0; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar h2 { padding: 0 20px 20px; font-size: 18px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar nav a { display: flex; align-items: center; gap: 10px; padding: 12px 20px; color: #ccc; text-decoration: none; font-size: 14px; transition: all 0.2s; }
        .sidebar nav a:hover, .sidebar nav a.active { background: rgba(255,255,255,0.1); color: #d4a853; }
        .sidebar nav a span { font-size: 18px; }
        .main-content { margin-left: 250px; flex: 1; padding: 30px; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #e0e0e0; }
        .top-bar h1 { font-size: 24px; color: #1a2332; }
        .btn { padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; transition: all 0.2s; }
        .btn-primary { background: #d4a853; color: #fff; }
        .btn-primary:hover { background: #c4983f; }
        .btn-danger { background: #e74c3c; color: #fff; }
        .btn-danger:hover { background: #c0392b; }
        .btn-sm { padding: 6px 12px; font-size: 12px; }
        .btn-outline { background: transparent; border: 2px solid #d4a853; color: #d4a853; }
        .table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .table th { background: #1a2332; color: #fff; padding: 14px 16px; text-align: left; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; }
        .table td { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
        .table tr:hover { background: #fafafa; }
        .card { background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px; color: #555; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 14px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; font-family: inherit; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #d4a853; outline: none; }
        .form-group textarea { min-height: 150px; resize: vertical; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 30px; }
        .stat-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .stat-card h3 { font-size: 28px; color: #1a2332; }
        .stat-card p { font-size: 14px; color: #888; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #d4edda; color: #155724; }
        .toggle { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
        .toggle.on { background: #27ae60; }
        .toggle.off { background: #e74c3c; }
        .actions { display: flex; gap: 6px; }
        @media (max-width: 768px) {
            .sidebar { width: 60px; }
            .sidebar h2, .sidebar nav a span.label { display: none; }
            .main-content { margin-left: 60px; }
        }
    </style>
</head>
<body>
<div class="admin-wrap">
    <aside class="sidebar">
        <h2>&#128274; CMS Admin</h2>
        <nav>
            <a href="/admin/?page=dashboard" class="<?= $page === 'dashboard' ? 'active' : '' ?>"><span>&#128200;</span> <span class="label">Dashboard</span></a>
            <a href="/admin/?page=services" class="<?= $page === 'services' ? 'active' : '' ?>"><span>&#128736;</span> <span class="label">Services</span></a>
            <a href="/admin/?page=locations" class="<?= $page === 'locations' ? 'active' : '' ?>"><span>&#128205;</span> <span class="label">Locations</span></a>
            <a href="/admin/?page=brands" class="<?= $page === 'brands' ? 'active' : '' ?>"><span>&#128663;</span> <span class="label">Car Brands</span></a>
            <a href="/admin/?page=reviews" class="<?= $page === 'reviews' ? 'active' : '' ?>"><span>&#11088;</span> <span class="label">Reviews</span></a>
            <a href="/admin/?page=faqs" class="<?= $page === 'faqs' ? 'active' : '' ?>"><span>&#10067;</span> <span class="label">FAQs</span></a>
            <a href="/admin/?page=blog" class="<?= $page === 'blog' ? 'active' : '' ?>"><span>&#128221;</span> <span class="label">Blog</span></a>
            <a href="/admin/?page=quotes" class="<?= $page === 'quotes' ? 'active' : '' ?>"><span>&#128233;</span> <span class="label">Leads/Quotes</span></a>
            <a href="/admin/?page=settings" class="<?= $page === 'settings' ? 'active' : '' ?>"><span>&#9881;</span> <span class="label">Settings</span></a>
            <a href="/admin/?logout=1"><span>&#128682;</span> <span class="label">Logout</span></a>
            <a href="/" target="_blank"><span>&#127760;</span> <span class="label">View Site</span></a>
        </nav>
    </aside>
    <main class="main-content">
        <?php
        $viewFile = __DIR__ . '/' . $page . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            echo '<div class="top-bar"><h1>Page Not Found</h1></div><p>Admin page "' . htmlspecialchars($page) . '" not found.</p>';
        }
        ?>
    </main>
</div>
</body>
</html>
