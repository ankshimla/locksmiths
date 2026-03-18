<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($metaTitle ?? $pageTitle ?? 'Locksmiths.ie') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? '') ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl ?? SITE_URL) ?>">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="<?= htmlspecialchars($metaTitle ?? '') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription ?? '') ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl ?? SITE_URL) ?>">
    <meta property="og:site_name" content="Locksmiths.ie">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- Schema markup injected per page -->
    <?= $schemaMarkup ?? '' ?>
</head>
<body>
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main id="main-content">
        <?= $content ?>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>

    <?php require __DIR__ . '/../partials/sticky-cta.php'; ?>

    <script src="/public/js/main.js" defer></script>
</body>
</html>
