<?php
/**
 * Database Configuration - Locksmiths.ie CMS
 * Uses MySQL for Cloudways and most shared hosting.
 */

// Database credentials - loaded from config file if it exists
$dbConfigFile = __DIR__ . '/../data/db-config.php';
if (file_exists($dbConfigFile)) {
    require_once $dbConfigFile;
}

// Defaults (overridden by db-config.php)
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_NAME')) define('DB_NAME', '');
if (!defined('DB_USER')) define('DB_USER', '');
if (!defined('DB_PASS')) define('DB_PASS', '');

define('DB_CONFIGURED', DB_NAME !== '' && DB_USER !== '');

define('SITE_NAME', 'Locksmiths.ie');
define('SITE_URL', 'https://locksmiths.ie');
define('SITE_PHONE', '01 234 5678');
define('SITE_PHONE_LINK', 'tel:+35312345678');
define('SITE_EMAIL', 'info@locksmiths.ie');
define('SITE_ADDRESS', 'Dublin, Ireland');
define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', '$2y$10$defaultHashChangeMe123456789012345678901234567890');

function getDB(): PDO {
    static $db = null;
    if ($db === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $db = new PDO($dsn, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return $db;
}
