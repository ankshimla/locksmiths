<?php if (!empty($locations) && is_array($locations)): ?>
<section class="locations-grid-section" aria-label="Service areas">
    <div class="container">

        <ul class="locations-grid" role="list">
            <?php foreach ($locations as $location): ?>
                <?php
                $slug = htmlspecialchars($location['slug'] ?? '');
                $name = htmlspecialchars($location['name'] ?? '');
                ?>
                <li class="location-card">
                    <a
                        href="/locksmiths-<?= $slug ?>"
                        class="location-card__link"
                        aria-label="Locksmith services in <?= $name ?>"
                    >
                        <article class="location-card__inner">

                            <span class="location-card__icon" aria-hidden="true">&#128205;</span>

                            <h3 class="location-card__name">
                                <?= $name ?>
                            </h3>

                            <p class="location-card__subtitle">
                                Locksmith Services
                            </p>

                            <span class="location-card__arrow" aria-hidden="true">&#8594;</span>

                        </article>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    </div><!-- /.container -->
</section>
<?php endif; ?>
