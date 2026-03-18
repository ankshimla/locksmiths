<?php if (!empty($breadcrumbs) && is_array($breadcrumbs)): ?>
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <div class="container">
        <ol class="breadcrumb-list" role="list" itemscope itemtype="https://schema.org/BreadcrumbList">
            <?php foreach ($breadcrumbs as $index => $crumb): ?>
                <?php $isLast = ($index === array_key_last($breadcrumbs)); ?>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <?php if (!empty($crumb['url']) && !$isLast): ?>
                        <a href="<?= htmlspecialchars($crumb['url']) ?>" itemprop="item">
                            <span itemprop="name"><?= htmlspecialchars($crumb['name']) ?></span>
                        </a>
                    <?php else: ?>
                        <span aria-current="page" itemprop="name"><?= htmlspecialchars($crumb['name']) ?></span>
                    <?php endif; ?>
                    <meta itemprop="position" content="<?= $index + 1 ?>">
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
<?php endif; ?>
