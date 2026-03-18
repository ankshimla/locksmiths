<?php
/**
 * Service Controller - Handles all service pages
 */
class ServiceController extends Controller {

    public function show(array $params): void {
        $slug = $params['slug'] ?? '';
        $model = new Service();
        $service = $model->getWithFaqs($slug);

        if (!$service) {
            http_response_code(404);
            $page = new PageController();
            $page->notFound();
            return;
        }

        $locationModel = new Location();
        $locations = $locationModel->getActive();

        $serviceModel = new Service();
        $allServices = $serviceModel->getActive();

        $schemas = [
            $this->localBusinessSchema(),
            $this->serviceSchema($service['name'], $service['intro'], SITE_URL . '/' . $service['slug']),
            $this->breadcrumbSchema([
                ['name' => 'Home', 'url' => SITE_URL],
                ['name' => $service['name']]
            ])
        ];

        if (!empty($service['faqs'])) {
            $schemas[] = $this->faqSchema($service['faqs']);
        }

        if (!empty($service['reviews'])) {
            $schemas[0]['review'] = $this->reviewSchema($service['reviews']);
        }

        $this->view('pages/service', [
            'pageTitle' => $service['name'],
            'metaTitle' => $service['meta_title'],
            'metaDescription' => $service['meta_description'],
            'canonicalUrl' => SITE_URL . '/' . $service['slug'],
            'schemaMarkup' => $this->generateSchema($schemas),
            'service' => $service,
            'locations' => $locations,
            'services' => $allServices,
            'faqs' => $service['faqs'] ?? [],
            'reviews' => $service['reviews'] ?? [],
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => $service['name']]
            ]
        ]);
    }
}
