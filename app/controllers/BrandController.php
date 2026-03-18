<?php
/**
 * Brand Controller - Handles car brand auto locksmith pages
 */
class BrandController extends Controller {

    public function show(array $params): void {
        $slug = $params['brand'] ?? '';
        $model = new Brand();
        $brand = $model->getWithFaqs($slug);

        if (!$brand) {
            http_response_code(404);
            $page = new PageController();
            $page->notFound();
            return;
        }

        $brandModel = new Brand();
        $allBrands = $brandModel->getActive();

        $serviceModel = new Service();
        $services = $serviceModel->getActive();

        $schemas = [
            $this->localBusinessSchema(),
            $this->serviceSchema(
                $brand['name'] . ' Auto Locksmith Services',
                $brand['intro'],
                SITE_URL . '/auto-locksmith-' . $brand['slug']
            ),
            $this->breadcrumbSchema([
                ['name' => 'Home', 'url' => SITE_URL],
                ['name' => 'Auto Locksmiths', 'url' => SITE_URL . '/auto-locksmiths'],
                ['name' => $brand['name'] . ' Locksmith']
            ])
        ];

        if (!empty($brand['faqs'])) {
            $schemas[] = $this->faqSchema($brand['faqs']);
        }

        if (!empty($brand['reviews'])) {
            $schemas[0]['review'] = $this->reviewSchema($brand['reviews']);
        }

        $this->view('pages/brand', [
            'pageTitle' => $brand['name'] . ' Auto Locksmith',
            'metaTitle' => $brand['meta_title'],
            'metaDescription' => $brand['meta_description'],
            'canonicalUrl' => SITE_URL . '/auto-locksmith-' . $brand['slug'],
            'schemaMarkup' => $this->generateSchema($schemas),
            'brand' => $brand,
            'brands' => $allBrands,
            'services' => $services,
            'faqs' => $brand['faqs'] ?? [],
            'reviews' => $brand['reviews'] ?? [],
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => 'Auto Locksmiths', 'url' => '/auto-locksmiths'],
                ['name' => $brand['name']]
            ]
        ]);
    }
}
