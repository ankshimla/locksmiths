<?php require __DIR__ . '/../partials/breadcrumbs.php'; ?>

<section class="page-hero blog-hero">
    <div class="container">
        <h1>Locksmith Tips & Security Blog</h1>
        <p class="hero-intro">Expert advice, security tips, and industry insights from Ireland's leading locksmith company</p>
    </div>
</section>

<section class="section page-content">
    <div class="container">
        <?php if (!empty($posts)): ?>
            <div class="blog-grid">
                <?php foreach ($posts as $post): ?>
                    <article class="blog-card animate-on-scroll">
                        <div class="blog-card-body">
                            <span class="blog-date"><?= date('d M Y', strtotime($post['created_at'])) ?></span>
                            <h2><a href="/blog/<?= htmlspecialchars($post['slug']) ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                            <p><?= htmlspecialchars($post['excerpt']) ?></p>
                            <a href="/blog/<?= htmlspecialchars($post['slug']) ?>" class="btn btn-outline">Read More</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">No blog posts yet. Check back soon!</p>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/../partials/cta-banner.php'; ?>
