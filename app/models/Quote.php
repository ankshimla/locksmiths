<?php
class Quote extends Model {
    protected string $table = 'quotes';

    public function getRecent(int $limit = 50): array {
        $stmt = $this->db->prepare("SELECT * FROM quotes ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}
