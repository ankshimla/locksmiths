<?php
/**
 * Admin Panel - Locksmiths.ie CMS
 */
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Model.php';

// Load models
foreach (glob(__DIR__ . '/../app/models/*.php') as $model) {
    require_once $model;
}

// Initialize DB if needed
try {
    $db = getDB();
    $db->query("SELECT 1 FROM services LIMIT 1");
} catch (Exception $e) {
    require_once __DIR__ . '/../data/install.php';
    installDatabase();
}

// Simple auth
$loggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $db = getDB();
    $stmt = $db->prepare("SELECT setting_value FROM settings WHERE setting_key = 'admin_password_hash'");
    $stmt->execute();
    $row = $stmt->fetch();
    $hash = $row ? $row['setting_value'] : ADMIN_PASS_HASH;

    if ($username === ADMIN_USER && password_verify($password, $hash)) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/');
        exit;
    } else {
        $loginError = 'Invalid username or password.';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /admin/');
    exit;
}

// Route admin pages
$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'list';
$id = (int)($_GET['id'] ?? 0);

if (!$loggedIn) {
    require __DIR__ . '/views/login.php';
    exit;
}

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $loggedIn) {
    handlePost($page, $action, $id);
}

// Render admin page
require __DIR__ . '/views/layout.php';

function handlePost(string $page, string $action, int $id): void {
    $db = getDB();

    if ($page === 'services' && $action === 'save') {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'meta_title' => trim($_POST['meta_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'h1' => trim($_POST['h1'] ?? ''),
            'intro' => trim($_POST['intro'] ?? ''),
            'content' => $_POST['content'] ?? '',
            'icon' => trim($_POST['icon'] ?? ''),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'active' => isset($_POST['active']) ? 1 : 0,
        ];
        $model = new Service();
        if ($id > 0) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        header('Location: /admin/?page=services');
        exit;
    }

    if ($page === 'locations' && $action === 'save') {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'county' => trim($_POST['county'] ?? 'Dublin'),
            'meta_title' => trim($_POST['meta_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'h1' => trim($_POST['h1'] ?? ''),
            'intro' => trim($_POST['intro'] ?? ''),
            'content' => $_POST['content'] ?? '',
            'lat' => trim($_POST['lat'] ?? ''),
            'lng' => trim($_POST['lng'] ?? ''),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'active' => isset($_POST['active']) ? 1 : 0,
        ];
        $model = new Location();
        if ($id > 0) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        header('Location: /admin/?page=locations');
        exit;
    }

    if ($page === 'brands' && $action === 'save') {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'meta_title' => trim($_POST['meta_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'h1' => trim($_POST['h1'] ?? ''),
            'intro' => trim($_POST['intro'] ?? ''),
            'content' => $_POST['content'] ?? '',
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
            'active' => isset($_POST['active']) ? 1 : 0,
        ];
        $model = new Brand();
        if ($id > 0) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        header('Location: /admin/?page=brands');
        exit;
    }

    if ($page === 'reviews' && $action === 'save') {
        $data = [
            'page_type' => trim($_POST['page_type'] ?? ''),
            'page_id' => (int)($_POST['page_id'] ?? 0),
            'name' => trim($_POST['name'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'rating' => (int)($_POST['rating'] ?? 5),
            'text' => trim($_POST['text'] ?? ''),
            'date' => trim($_POST['date'] ?? date('Y-m-d')),
            'active' => isset($_POST['active']) ? 1 : 0,
        ];
        $model = new Review();
        if ($id > 0) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        header('Location: /admin/?page=reviews');
        exit;
    }

    if ($page === 'faqs' && $action === 'save') {
        $data = [
            'page_type' => trim($_POST['page_type'] ?? ''),
            'page_id' => (int)($_POST['page_id'] ?? 0),
            'question' => trim($_POST['question'] ?? ''),
            'answer' => trim($_POST['answer'] ?? ''),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
        ];
        $model = new Faq();
        if ($id > 0) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
        header('Location: /admin/?page=faqs');
        exit;
    }

    if ($page === 'blog' && $action === 'save') {
        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'meta_title' => trim($_POST['meta_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'content' => $_POST['content'] ?? '',
            'excerpt' => trim($_POST['excerpt'] ?? ''),
            'author' => trim($_POST['author'] ?? 'Locksmiths.ie'),
            'status' => trim($_POST['status'] ?? 'draft'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $model = new BlogPost();
        if ($id > 0) {
            $model->update($id, $data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $model->insert($data);
        }
        header('Location: /admin/?page=blog');
        exit;
    }

    if ($page === 'settings' && $action === 'save') {
        foreach ($_POST['settings'] ?? [] as $key => $value) {
            $stmt = $db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
            $stmt->execute([$key, trim($value)]);
        }
        header('Location: /admin/?page=settings&saved=1');
        exit;
    }

    // Delete actions
    if ($action === 'delete' && $id > 0) {
        $tables = ['services' => 'services', 'locations' => 'locations', 'brands' => 'brands', 'reviews' => 'reviews', 'faqs' => 'faqs', 'blog' => 'blog_posts', 'quotes' => 'quotes'];
        if (isset($tables[$page])) {
            $stmt = $db->prepare("DELETE FROM {$tables[$page]} WHERE id = ?");
            $stmt->execute([$id]);
        }
        header("Location: /admin/?page={$page}");
        exit;
    }
}
