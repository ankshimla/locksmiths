<?php
class Service extends Model {
    protected string $table = 'services';

    public function getActive(): array {
        $stmt = $this->db->query("SELECT * FROM services WHERE active = 1 ORDER BY sort_order ASC");
        return $stmt->fetchAll();
    }

    public function getWithFaqs(string $slug): ?array {
        $service = $this->findBySlug($slug);
        if (!$service) return null;

        $stmt = $this->db->prepare("SELECT * FROM faqs WHERE page_type = 'service' AND page_id = ? ORDER BY sort_order ASC");
        $stmt->execute([$service['id']]);
        $service['faqs'] = $stmt->fetchAll();

        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE page_type = 'service' AND page_id = ? AND active = 1 ORDER BY id DESC LIMIT 6");
        $stmt->execute([$service['id']]);
        $service['reviews'] = $stmt->fetchAll();

        return $service;
    }
}
