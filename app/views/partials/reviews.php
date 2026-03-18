<section class="reviews-section" aria-label="Customer reviews">
    <div class="container">

        <div class="section-header reviews-section__header">
            <h2 class="section-title">What Our Customers Say</h2>

            <!-- Google-style aggregate rating badge -->
            <div class="rating-badge" aria-label="Rated 4.9 out of 5 from 387 reviews">
                <span class="rating-badge__logo" aria-hidden="true">G</span>
                <div class="rating-badge__info">
                    <div class="rating-badge__stars" aria-hidden="true">
                        <span class="star star--full">&#9733;</span>
                        <span class="star star--full">&#9733;</span>
                        <span class="star star--full">&#9733;</span>
                        <span class="star star--full">&#9733;</span>
                        <span class="star star--full">&#9733;</span>
                    </div>
                    <div class="rating-badge__score">
                        <strong>4.9</strong>
                        <span class="rating-badge__count">/ 5 &bull; 387 reviews</span>
                    </div>
                </div>
            </div>
        </div><!-- /.section-header -->

        <?php if (!empty($reviews)): ?>
            <ul class="reviews-grid" role="list">
                <?php foreach ($reviews as $review): ?>
                    <li class="review-card">
                        <!-- Star rating -->
                        <div class="review-card__stars" aria-label="<?= (int)($review['rating'] ?? 5) ?> out of 5 stars">
                            <?php
                            $rating = (int)($review['rating'] ?? 5);
                            for ($i = 1; $i <= 5; $i++):
                            ?>
                                <span class="star <?= $i <= $rating ? 'star--full' : 'star--empty' ?>" aria-hidden="true">
                                    <?= $i <= $rating ? '&#9733;' : '&#9734;' ?>
                                </span>
                            <?php endfor; ?>
                        </div>

                        <!-- Review text -->
                        <blockquote class="review-card__text">
                            <p><?= htmlspecialchars($review['text'] ?? $review['review_text'] ?? '') ?></p>
                        </blockquote>

                        <!-- Reviewer info -->
                        <footer class="review-card__footer">
                            <span class="review-card__name">
                                <?= htmlspecialchars($review['name'] ?? $review['author_name'] ?? 'Anonymous') ?>
                            </span>
                            <?php if (!empty($review['location'])): ?>
                                <span class="review-card__location">
                                    &#8212; <?= htmlspecialchars($review['location']) ?>
                                </span>
                            <?php endif; ?>
                        </footer>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="reviews-empty">No reviews to display yet.</p>
        <?php endif; ?>

    </div><!-- /.container -->
</section>
