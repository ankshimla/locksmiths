<?php
/**
 * Blog Controller - Handles blog listing and individual posts
 */
class BlogController extends Controller {

    public function index(array $params = []): void {
        $model = new BlogPost();
        $posts = $model->getPublished();

        $schemas = [
            $this->localBusinessSchema(),
            $this->breadcrumbSchema([
                ['name' => 'Home', 'url' => SITE_URL],
                ['name' => 'Blog']
            ])
        ];

        $this->view('pages/blog', [
            'pageTitle' => 'Blog',
            'metaTitle' => 'Locksmith Tips & Security Blog | Locksmiths.ie',
            'metaDescription' => 'Expert locksmith advice, security tips, and industry news from Ireland\'s top-rated locksmith company. Stay informed about home and business security.',
            'canonicalUrl' => SITE_URL . '/blog',
            'schemaMarkup' => $this->generateSchema($schemas),
            'posts' => $posts,
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => 'Blog']
            ]
        ]);
    }

    public function show(array $params): void {
        $slug = $params['slug'] ?? '';
        $model = new BlogPost();
        $post = $model->getBySlug($slug);

        if (!$post) {
            http_response_code(404);
            $page = new PageController();
            $page->notFound();
            return;
        }

        $schemas = [
            $this->localBusinessSchema(),
            [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $post['title'],
                'description' => $post['meta_description'] ?? $post['excerpt'],
                'author' => ['@type' => 'Organization', 'name' => SITE_NAME],
                'datePublished' => $post['created_at'],
                'dateModified' => $post['updated_at'] ?? $post['created_at'],
                'publisher' => ['@type' => 'Organization', 'name' => SITE_NAME]
            ],
            $this->breadcrumbSchema([
                ['name' => 'Home', 'url' => SITE_URL],
                ['name' => 'Blog', 'url' => SITE_URL . '/blog'],
                ['name' => $post['title']]
            ])
        ];

        $this->view('pages/blog-post', [
            'pageTitle' => $post['title'],
            'metaTitle' => $post['meta_title'] ?? $post['title'] . ' | Locksmiths.ie Blog',
            'metaDescription' => $post['meta_description'] ?? $post['excerpt'],
            'canonicalUrl' => SITE_URL . '/blog/' . $post['slug'],
            'schemaMarkup' => $this->generateSchema($schemas),
            'post' => $post,
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => 'Blog', 'url' => '/blog'],
                ['name' => $post['title']]
            ]
        ]);
    }
}
