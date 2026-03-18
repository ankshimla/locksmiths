<section class="faq-section" aria-label="Frequently asked questions">
    <div class="container">

        <div class="section-header">
            <h2 class="section-title">Frequently Asked Questions</h2>
        </div>

        <?php if (!empty($faqs)): ?>
            <dl class="faq-list" id="faq-accordion">
                <?php foreach ($faqs as $index => $faq): ?>
                    <?php
                    $itemId  = 'faq-item-' . $index;
                    $answerId = 'faq-answer-' . $index;
                    ?>
                    <div class="faq-item" id="<?= htmlspecialchars($itemId) ?>">

                        <dt class="faq-question-wrapper">
                            <button
                                class="faq-question"
                                type="button"
                                aria-expanded="false"
                                aria-controls="<?= htmlspecialchars($answerId) ?>"
                                id="<?= htmlspecialchars($itemId) ?>-btn"
                            >
                                <span class="faq-question__text">
                                    <?= htmlspecialchars($faq['question'] ?? '') ?>
                                </span>
                                <span class="faq-question__icon" aria-hidden="true">
                                    <span class="faq-icon-plus">+</span>
                                    <span class="faq-icon-minus" hidden>&minus;</span>
                                </span>
                            </button>
                        </dt>

                        <dd
                            class="faq-answer"
                            id="<?= htmlspecialchars($answerId) ?>"
                            role="region"
                            aria-labelledby="<?= htmlspecialchars($itemId) ?>-btn"
                            hidden
                        >
                            <div class="faq-answer__inner">
                                <?= nl2br(htmlspecialchars($faq['answer'] ?? '')) ?>
                            </div>
                        </dd>

                    </div><!-- /.faq-item -->
                <?php endforeach; ?>
            </dl>
        <?php else: ?>
            <p class="faq-empty">No frequently asked questions available.</p>
        <?php endif; ?>

    </div><!-- /.container -->
</section>
