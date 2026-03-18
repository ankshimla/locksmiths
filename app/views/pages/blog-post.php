<?php require __DIR__ . '/../partials/breadcrumbs.php'; ?>

<article class="section page-content blog-post-page">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <header class="blog-post-header">
                    <h1><?= htmlspecialchars($post['title']) ?></h1>
                    <div class="blog-post-meta">
                        <span class="blog-date">Published: <?= date('d M Y', strtotime($post['created_at'])) ?></span>
                        <span class="blog-author">By <?= htmlspecialchars($post['author']) ?></span>
                    </div>
                </header>
                <div class="content-body blog-content">
                    <?= $post['content'] ?>
                </div>

                <div class="blog-post-footer">
                    <a href="/blog" class="btn btn-outline">&larr; Back to Blog</a>
                </div>
            </div>

            <aside class="content-sidebar">
                <?php require __DIR__ . '/../partials/quote-form.php'; ?>

                <div class="sidebar-cta glass-card">
                    <h3>Need a Locksmith?</h3>
                    <p>We're available 24/7 across Dublin and Ireland.</p>
                    <a href="<?= SITE_PHONE_LINK ?>" class="btn btn-call btn-block">Call <?= SITE_PHONE ?></a>
                </div>
            </aside>
        </div>
    </div>
</article>
