<?php if (!empty($services) && is_array($services)): ?>
<div class="services-grid">
    <?php foreach ($services as $service): ?>
        <?php
        $slug  = htmlspecialchars($service['slug'] ?? '');
        $name  = htmlspecialchars($service['name'] ?? $service['title'] ?? '');
        $icon  = $service['icon'] ?? '&#128273;';
        $intro = $service['meta_description'] ?? $service['intro'] ?? '';
        if (mb_strlen($intro) > 120) {
            $intro = mb_substr($intro, 0, 120);
            $intro = mb_substr($intro, 0, mb_strrpos($intro, ' ')) . '...';
        }
        $intro = htmlspecialchars($intro);
        ?>
        <div class="service-card">
            <div class="service-card-icon" aria-hidden="true">
                <?= $icon ?>
            </div>
            <h3><?= $name ?></h3>
            <?php if (!empty($intro)): ?>
                <p><?= $intro ?></p>
            <?php endif; ?>
            <a href="/<?= $slug ?>" class="service-card-link" aria-label="Learn more about <?= $name ?>">
                Learn More
            </a>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
