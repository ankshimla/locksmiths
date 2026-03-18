<?php
class BlogPost extends Model {
    protected string $table = 'blog_posts';

    public function getPublished(int $limit = 20): array {
        $stmt = $this->db->prepare("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    public function getBySlug(string $slug): ?array {
        $stmt = $this->db->prepare("SELECT * FROM blog_posts WHERE slug = ? AND status = 'published'");
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    }
}
