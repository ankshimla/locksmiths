<?php if (!empty($locations) && is_array($locations)): ?>
<div class="locations-grid">
    <?php foreach ($locations as $location): ?>
        <?php
        $slug = htmlspecialchars($location['slug'] ?? '');
        $name = htmlspecialchars($location['name'] ?? '');
        ?>
        <a href="/locksmiths-<?= $slug ?>" class="location-card" aria-label="Locksmith services in <?= $name ?>">
            <span class="location-card-icon" aria-hidden="true">&#128205;</span>
            <?= $name ?>
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>
