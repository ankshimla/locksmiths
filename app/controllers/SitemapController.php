<?php
/**
 * Sitemap Controller - Generates XML sitemap
 */
class SitemapController extends Controller {

    public function index(): void {
        header('Content-Type: application/xml; charset=utf-8');

        $serviceModel = new Service();
        $locationModel = new Location();
        $brandModel = new Brand();
        $blogModel = new BlogPost();

        $services = $serviceModel->getActive();
        $locations = $locationModel->getActive();
        $brands = $brandModel->getActive();
        $posts = $blogModel->getPublished();

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        $this->addUrl(SITE_URL . '/', '1.0', 'daily');

        // Static pages
        $staticPages = ['/about', '/contact', '/blog'];
        foreach ($staticPages as $page) {
            $this->addUrl(SITE_URL . $page, '0.8', 'weekly');
        }

        // Service pages
        foreach ($services as $service) {
            $this->addUrl(SITE_URL . '/' . $service['slug'], '0.9', 'weekly');
        }

        // Location pages
        foreach ($locations as $location) {
            $this->addUrl(SITE_URL . '/locksmiths-' . $location['slug'], '0.9', 'weekly');
        }

        // Brand pages
        foreach ($brands as $brand) {
            $this->addUrl(SITE_URL . '/auto-locksmith-' . $brand['slug'], '0.8', 'weekly');
        }

        // Blog posts
        foreach ($posts as $post) {
            $this->addUrl(SITE_URL . '/blog/' . $post['slug'], '0.7', 'monthly');
        }

        echo '</urlset>';
        exit;
    }

    private function addUrl(string $url, string $priority, string $changefreq): void {
        echo "  <url>\n";
        echo "    <loc>" . htmlspecialchars($url) . "</loc>\n";
        echo "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        echo "    <changefreq>{$changefreq}</changefreq>\n";
        echo "    <priority>{$priority}</priority>\n";
        echo "  </url>\n";
    }
}
