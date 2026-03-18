<?php
/**
 * Setup Wizard - Locksmiths.ie CMS
 * Checks server requirements, collects MySQL details, and installs the database
 */
$errors = [];
$warnings = [];
$success = false;
$needsConfig = !file_exists(__DIR__ . '/data/db-config.php');

// Check PHP version
if (version_compare(PHP_VERSION, '7.4', '<')) {
    $errors[] = 'PHP 7.4 or higher required. Current: ' . PHP_VERSION;
}

// Check MySQL PDO
if (!extension_loaded('pdo_mysql')) {
    $errors[] = 'PDO MySQL extension is not enabled. Contact your hosting provider to enable it.';
}

// Check mod_rewrite (only if Apache)
if (function_exists('apache_get_modules')) {
    if (!in_array('mod_rewrite', apache_get_modules())) {
        $warnings[] = 'mod_rewrite may not be enabled. Clean URLs might not work.';
    }
}

// Check data directory
$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    if (!@mkdir($dataDir, 0755, true)) {
        $errors[] = "Cannot create data/ directory. Please create it manually and set permissions to 755.";
    }
}
if (is_dir($dataDir) && !is_writable($dataDir)) {
    $errors[] = "data/ directory is not writable. Run: <code>chmod 755 data/</code> or set permissions to 755 in your file manager.";
}

// Check if already installed
$alreadyInstalled = false;
if (!$needsConfig) {
    require_once __DIR__ . '/config/database.php';
    try {
        $testDb = getDB();
        $testDb->query("SELECT 1 FROM services LIMIT 1");
        $alreadyInstalled = true;
    } catch (Exception $e) {
        $alreadyInstalled = false;
    }
}

// Handle install action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['install']) && empty($errors)) {
    try {
        $dbHost = trim($_POST['db_host'] ?? 'localhost');
        $dbName = trim($_POST['db_name'] ?? '');
        $dbUser = trim($_POST['db_user'] ?? '');
        $dbPass = $_POST['db_pass'] ?? '';

        if (empty($dbName) || empty($dbUser)) {
            throw new Exception('Database name and username are required.');
        }

        // Test connection first
        $testDsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
        $testPdo = new PDO($testDsn, $dbUser, $dbPass);
        $testPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Save config
        $configContent = "<?php\n";
        $configContent .= "define('DB_HOST', " . var_export($dbHost, true) . ");\n";
        $configContent .= "define('DB_NAME', " . var_export($dbName, true) . ");\n";
        $configContent .= "define('DB_USER', " . var_export($dbUser, true) . ");\n";
        $configContent .= "define('DB_PASS', " . var_export($dbPass, true) . ");\n";
        file_put_contents(__DIR__ . '/data/db-config.php', $configContent);

        require_once __DIR__ . '/config/database.php';
        require_once __DIR__ . '/core/Model.php';

        // Load models needed by install
        foreach (glob(__DIR__ . '/app/models/*.php') as $model) {
            require_once $model;
        }

        require_once __DIR__ . '/data/install.php';
        installDatabase();

        $success = true;
        $alreadyInstalled = true;
    } catch (Exception $e) {
        $errors[] = 'Installation failed: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locksmiths.ie - Setup</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #1a2332 0%, #2c3e6b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .setup-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            max-width: 650px;
            width: 100%;
            padding: 3rem;
        }
        .logo { text-align: center; margin-bottom: 2rem; }
        .logo-icon { font-size: 3rem; }
        .logo-text { font-size: 1.8rem; font-weight: 800; color: #1a2332; }
        .logo-dot { color: #d4a853; }
        h1 { text-align: center; color: #1a2332; margin-bottom: 0.5rem; font-size: 1.5rem; }
        .subtitle { text-align: center; color: #666; margin-bottom: 2rem; }
        .check-list { list-style: none; margin: 1.5rem 0; }
        .check-list li {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.95rem;
        }
        .check-pass { background: #e8f5e9; color: #2e7d32; }
        .check-fail { background: #ffebee; color: #c62828; }
        .check-warn { background: #fff8e1; color: #f57f17; }
        .check-icon { font-size: 1.2rem; flex-shrink: 0; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 0.3rem; color: #333; font-size: 0.9rem; }
        .form-group input {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        .form-group input:focus { outline: none; border-color: #d4a853; }
        .form-group small { color: #888; font-size: 0.8rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .db-section { background: #f8f9fa; border-radius: 10px; padding: 1.5rem; margin: 1.5rem 0; }
        .db-section h3 { color: #1a2332; margin-bottom: 1rem; font-size: 1.1rem; }
        .btn-install {
            display: block;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #d4a853, #b8922f);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-install:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(212,168,83,0.4); }
        .btn-install:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; }
        .success-box {
            background: #e8f5e9;
            border: 2px solid #4caf50;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            margin: 1.5rem 0;
        }
        .success-box h2 { color: #2e7d32; margin-bottom: 0.5rem; }
        .success-box a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.75rem 2rem;
            background: #2e7d32;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
        .success-box a:hover { background: #1b5e20; }
        code { background: #f5f5f5; padding: 2px 6px; border-radius: 4px; font-size: 0.9em; }
        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }
        .info-box h3 { color: #1a2332; margin-bottom: 0.75rem; font-size: 1rem; }
        .info-box ol { padding-left: 1.5rem; }
        .info-box li { margin-bottom: 0.5rem; color: #555; font-size: 0.9rem; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="setup-card">
        <div class="logo">
            <span class="logo-icon">&#128273;</span><br>
            <span class="logo-text">Locksmiths<span class="logo-dot">.ie</span></span>
        </div>

        <?php if ($success): ?>
            <div class="success-box">
                <h2>&#10004; Installation Complete!</h2>
                <p>Your CMS is ready. The database has been created and seeded with initial data.</p>
                <a href="/">Visit Your Site</a>
            </div>
            <div class="info-box">
                <h3>Admin Panel</h3>
                <ol>
                    <li>Go to <code>/admin</code> to access the admin panel</li>
                    <li>Default login: <code>admin</code> / update password in admin Settings page</li>
                </ol>
            </div>

        <?php elseif ($alreadyInstalled): ?>
            <div class="success-box">
                <h2>&#10004; Already Installed</h2>
                <p>Your CMS database already exists and is ready to use.</p>
                <a href="/">Visit Your Site</a>
            </div>

        <?php else: ?>
            <h1>Setup Wizard</h1>
            <p class="subtitle">Let's check your server and install the CMS</p>

            <ul class="check-list">
                <li class="<?= version_compare(PHP_VERSION, '7.4', '>=') ? 'check-pass' : 'check-fail' ?>">
                    <span class="check-icon"><?= version_compare(PHP_VERSION, '7.4', '>=') ? '&#10004;' : '&#10008;' ?></span>
                    PHP <?= PHP_VERSION ?> (7.4+ required)
                </li>
                <li class="<?= extension_loaded('pdo_mysql') ? 'check-pass' : 'check-fail' ?>">
                    <span class="check-icon"><?= extension_loaded('pdo_mysql') ? '&#10004;' : '&#10008;' ?></span>
                    PDO MySQL Extension
                </li>
                <li class="<?= is_dir($dataDir) && is_writable($dataDir) ? 'check-pass' : 'check-fail' ?>">
                    <span class="check-icon"><?= is_dir($dataDir) && is_writable($dataDir) ? '&#10004;' : '&#10008;' ?></span>
                    data/ directory writable
                </li>
                <li class="check-pass">
                    <span class="check-icon">&#10004;</span>
                    CMS files present
                </li>
            </ul>

            <?php foreach ($errors as $err): ?>
                <p style="color: #c62828; margin-bottom: 0.5rem; font-size: 0.9rem;">&#9888; <?= $err ?></p>
            <?php endforeach; ?>
            <?php foreach ($warnings as $warn): ?>
                <p style="color: #f57f17; margin-bottom: 0.5rem; font-size: 0.9rem;">&#9888; <?= $warn ?></p>
            <?php endforeach; ?>

            <form method="POST">
                <div class="db-section">
                    <h3>&#128451; MySQL Database Details</h3>
                    <p style="color: #666; font-size: 0.85rem; margin-bottom: 1rem;">Find these in your Cloudways dashboard under Application &gt; Access Details</p>
                    <div class="form-group">
                        <label>Database Host</label>
                        <input type="text" name="db_host" value="<?= htmlspecialchars($_POST['db_host'] ?? 'localhost') ?>" required>
                        <small>Usually "localhost" on Cloudways</small>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Database Name</label>
                            <input type="text" name="db_name" value="<?= htmlspecialchars($_POST['db_name'] ?? '') ?>" required placeholder="e.g. eqdueglqgt">
                        </div>
                        <div class="form-group">
                            <label>Database Username</label>
                            <input type="text" name="db_user" value="<?= htmlspecialchars($_POST['db_user'] ?? '') ?>" required placeholder="e.g. eqdueglqgt">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Database Password</label>
                        <input type="password" name="db_pass" value="" placeholder="Your MySQL password">
                    </div>
                </div>

                <button type="submit" name="install" class="btn-install" <?= !empty($errors) ? 'disabled' : '' ?>>
                    &#128273; Install Locksmiths.ie CMS
                </button>
            </form>

            <div class="info-box">
                <h3>Where to find your database details (Cloudways)</h3>
                <ol>
                    <li>Log in to <strong>Cloudways</strong> dashboard</li>
                    <li>Go to <strong>Applications</strong> &gt; select your app</li>
                    <li>Click <strong>Access Details</strong> tab</li>
                    <li>Find <strong>MySQL Access</strong> section &mdash; copy DB Name, Username, and Password</li>
                </ol>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
