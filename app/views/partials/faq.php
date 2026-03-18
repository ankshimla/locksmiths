<?php if (!empty($faqs)): ?>
<div class="section-header">
    <span class="section-label">FAQ</span>
    <h2 class="section-title">Frequently Asked Questions</h2>
</div>

<div class="faq-list" id="faq-accordion">
    <?php foreach ($faqs as $index => $faq): ?>
        <div class="faq-item">
            <button class="faq-question" type="button" aria-expanded="false">
                <span><?= htmlspecialchars($faq['question'] ?? '') ?></span>
                <span class="faq-icon" aria-hidden="true">+</span>
            </button>
            <div class="faq-answer">
                <div class="faq-answer-inner">
                    <?= nl2br(htmlspecialchars($faq['answer'] ?? '')) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
