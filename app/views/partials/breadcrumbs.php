<?php if (!empty($breadcrumbs) && is_array($breadcrumbs)): ?>
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <ol class="breadcrumbs__list" role="list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <?php foreach ($breadcrumbs as $index => $crumb): ?>
            <?php
            $isLast  = ($index === array_key_last($breadcrumbs));
            $hasUrl  = !empty($crumb['url']);
            $pos     = $index + 1;
            ?>
            <li
                class="breadcrumbs__item<?= $isLast ? ' breadcrumbs__item--current' : '' ?>"
                itemprop="itemListElement"
                itemscope
                itemtype="https://schema.org/ListItem"
            >
                <?php if ($hasUrl && !$isLast): ?>
                    <a
                        href="<?= htmlspecialchars($crumb['url']) ?>"
                        class="breadcrumbs__link"
                        itemprop="item"
                    >
                        <span itemprop="name"><?= htmlspecialchars($crumb['name']) ?></span>
                    </a>
                <?php else: ?>
                    <span
                        class="breadcrumbs__current"
                        aria-current="page"
                        itemprop="name"
                    ><?= htmlspecialchars($crumb['name']) ?></span>
                <?php endif; ?>
                <meta itemprop="position" content="<?= $pos ?>">

                <?php if (!$isLast): ?>
                    <span class="breadcrumbs__separator" aria-hidden="true">&#8250;</span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>
