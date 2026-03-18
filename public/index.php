<?php
/**
 * Front Controller - All requests route through here
 * Locksmiths.ie CMS
 */
session_start();

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

// Load configuration
require_once __DIR__ . '/../config/database.php';

// Autoload core classes
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Router.php';

// Load models
foreach (glob(__DIR__ . '/../app/models/*.php') as $model) {
    require_once $model;
}

// Initialize database if needed
if (!file_exists(DB_PATH)) {
    // Ensure data directory exists and is writable
    $dataDir = dirname(DB_PATH);
    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0755, true);
    }
    if (!is_writable($dataDir)) {
        // Redirect to setup wizard
        header('Location: /index.php?setup=1');
        exit;
    }
    require_once __DIR__ . '/../data/install.php';
    installDatabase();
}

// Load routes and dispatch
$routes = require __DIR__ . '/../config/routes.php';
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_URI']);
