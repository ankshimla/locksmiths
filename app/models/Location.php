<?php
class Location extends Model {
    protected string $table = 'locations';

    public function getActive(): array {
        $stmt = $this->db->query("SELECT * FROM locations WHERE active = 1 ORDER BY name ASC");
        return $stmt->fetchAll();
    }

    public function getWithFaqs(string $slug): ?array {
        $location = $this->findBySlug($slug);
        if (!$location) return null;

        $stmt = $this->db->prepare("SELECT * FROM faqs WHERE page_type = 'location' AND page_id = ? ORDER BY sort_order ASC");
        $stmt->execute([$location['id']]);
        $location['faqs'] = $stmt->fetchAll();

        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE page_type = 'location' AND page_id = ? AND active = 1 ORDER BY id DESC LIMIT 6");
        $stmt->execute([$location['id']]);
        $location['reviews'] = $stmt->fetchAll();

        // Get nearby locations
        $stmt = $this->db->prepare("SELECT * FROM locations WHERE id != ? AND active = 1 ORDER BY RANDOM() LIMIT 6");
        $stmt->execute([$location['id']]);
        $location['nearby'] = $stmt->fetchAll();

        return $location;
    }
}
