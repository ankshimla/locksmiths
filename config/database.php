<?php
/**
 * Database Configuration - Locksmiths.ie CMS
 * Uses SQLite for portability. Switch to MySQL by changing DSN.
 */

define('DB_PATH', __DIR__ . '/../data/cms.db');
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
        $db = new PDO('sqlite:' . DB_PATH);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->exec('PRAGMA journal_mode=WAL');
        $db->exec('PRAGMA foreign_keys=ON');
    }
    return $db;
}
