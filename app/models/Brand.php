<?php
class Brand extends Model {
    protected string $table = 'brands';

    public function getActive(): array {
        $stmt = $this->db->query("SELECT * FROM brands WHERE active = 1 ORDER BY name ASC");
        return $stmt->fetchAll();
    }

    public function getWithFaqs(string $slug): ?array {
        $brand = $this->findBySlug($slug);
        if (!$brand) return null;

        $stmt = $this->db->prepare("SELECT * FROM faqs WHERE page_type = 'brand' AND page_id = ? ORDER BY sort_order ASC");
        $stmt->execute([$brand['id']]);
        $brand['faqs'] = $stmt->fetchAll();

        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE page_type = 'brand' AND page_id = ? AND active = 1 ORDER BY id DESC LIMIT 4");
        $stmt->execute([$brand['id']]);
        $brand['reviews'] = $stmt->fetchAll();

        return $brand;
    }
}
