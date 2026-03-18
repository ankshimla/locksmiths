<?php
class Faq extends Model {
    protected string $table = 'faqs';

    public function getForPage(string $pageType, int $pageId): array {
        $stmt = $this->db->prepare("SELECT * FROM faqs WHERE page_type = ? AND page_id = ? ORDER BY sort_order ASC");
        $stmt->execute([$pageType, $pageId]);
        return $stmt->fetchAll();
    }
}
