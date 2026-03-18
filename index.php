<?php
/**
 * Root Bootstrap - Locksmiths.ie CMS
 *
 * This file handles two scenarios:
 * 1. If public/ is NOT the document root (shared hosting), this routes to public/index.php
 * 2. Provides a setup check on first run
 */

// Check if this is a setup request or DB is not configured
if (isset($_GET['setup']) || !file_exists(__DIR__ . '/data/db-config.php')) {
    require_once __DIR__ . '/setup.php';
    exit;
}

// Check if mod_rewrite is working - if we're here, .htaccess didn't redirect
// Route to public/index.php manually
$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/public';

// Rewrite static file requests
$requestUri = $_SERVER['REQUEST_URI'];
$publicFile = __DIR__ . '/public' . parse_url($requestUri, PHP_URL_PATH);

// Serve static files directly
if (is_file($publicFile)) {
    $ext = pathinfo($publicFile, PATHINFO_EXTENSION);
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'webp' => 'image/webp',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
    ];
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
        readfile($publicFile);
        exit;
    }
}

// Route everything else through the front controller
require __DIR__ . '/public/index.php';
