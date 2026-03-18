<?php
class Review extends Model {
    protected string $table = 'reviews';

    public function getForPage(string $pageType, int $pageId, int $limit = 6): array {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE page_type = ? AND page_id = ? AND active = 1 ORDER BY id DESC LIMIT ?");
        $stmt->execute([$pageType, $pageId, $limit]);
        return $stmt->fetchAll();
    }

    public function getLatest(int $limit = 10): array {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE active = 1 ORDER BY id DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}
