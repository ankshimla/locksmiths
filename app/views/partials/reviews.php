<?php if (!empty($reviews)): ?>
<div class="section-header">
    <span class="section-label">Testimonials</span>
    <h2 class="section-title section-title--light">What Our Customers Say</h2>
    <p class="section-desc section-desc--light">Rated 4.9/5 from 387+ verified reviews</p>
</div>

<div class="reviews-grid">
    <?php foreach ($reviews as $review): ?>
        <div class="review-card">
            <!-- Star rating -->
            <div class="review-stars star-rating" aria-label="<?= (int)($review['rating'] ?? 5) ?> out of 5 stars">
                <?php
                $rating = (int)($review['rating'] ?? 5);
                for ($i = 1; $i <= 5; $i++):
                ?>
                    <span class="<?= $i <= $rating ? 'star-filled' : 'star-empty' ?>" aria-hidden="true">
                        <?= $i <= $rating ? '&#9733;' : '&#9734;' ?>
                    </span>
                <?php endfor; ?>
            </div>

            <!-- Review text -->
            <div class="review-text">
                <p><?= htmlspecialchars($review['text'] ?? $review['review_text'] ?? '') ?></p>
            </div>

            <!-- Reviewer info -->
            <div class="review-author">
                <div class="review-avatar">
                    <?= strtoupper(substr($review['name'] ?? $review['customer_name'] ?? 'A', 0, 1)) ?>
                </div>
                <div>
                    <div class="review-author-name">
                        <?= htmlspecialchars($review['name'] ?? $review['customer_name'] ?? 'Customer') ?>
                    </div>
                    <div class="review-author-location">Verified Customer</div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
