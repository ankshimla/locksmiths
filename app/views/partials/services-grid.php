<?php if (!empty($services) && is_array($services)): ?>
<section class="services-grid-section" aria-label="Our services">
    <div class="container">

        <ul class="services-grid" role="list">
            <?php foreach ($services as $service): ?>
                <?php
                $slug  = htmlspecialchars($service['slug'] ?? '');
                $name  = htmlspecialchars($service['name'] ?? $service['title'] ?? '');
                $icon  = $service['icon'] ?? '&#128273;';
                $intro = $service['intro'] ?? $service['excerpt'] ?? $service['short_description'] ?? '';
                // Truncate intro to 120 characters at a word boundary
                if (mb_strlen($intro) > 120) {
                    $intro = mb_substr($intro, 0, 120);
                    $intro = mb_substr($intro, 0, mb_strrpos($intro, ' ')) . '&hellip;';
                } else {
                    $intro = htmlspecialchars($intro);
                }
                ?>
                <li class="service-card">
                    <article class="service-card__inner">

                        <div class="service-card__icon" aria-hidden="true">
                            <?= $icon ?>
                        </div>

                        <h3 class="service-card__name">
                            <?= $name ?>
                        </h3>

                        <?php if (!empty($intro)): ?>
                            <p class="service-card__intro">
                                <?= $intro ?>
                            </p>
                        <?php endif; ?>

                        <a
                            href="/<?= $slug ?>"
                            class="service-card__link btn btn--outline btn--sm"
                            aria-label="Learn more about <?= $name ?>"
                        >
                            Learn More <span aria-hidden="true">&#8594;</span>
                        </a>

                    </article>
                </li>
            <?php endforeach; ?>
        </ul>

    </div><!-- /.container -->
</section>
<?php endif; ?>
