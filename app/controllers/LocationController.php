<?php
/**
 * Location Controller - Handles all location-specific pages
 */
class LocationController extends Controller {

    public function show(array $params): void {
        $slug = $params['location'] ?? '';
        $model = new Location();
        $location = $model->getWithFaqs($slug);

        if (!$location) {
            http_response_code(404);
            $page = new PageController();
            $page->notFound();
            return;
        }

        $serviceModel = new Service();
        $services = $serviceModel->getActive();

        $schemas = [
            $this->localBusinessSchema(),
            $this->breadcrumbSchema([
                ['name' => 'Home', 'url' => SITE_URL],
                ['name' => 'Locations', 'url' => SITE_URL . '/locksmiths-dublin'],
                ['name' => 'Locksmiths ' . $location['name']]
            ])
        ];

        // Add location-specific LocalBusiness
        $locBiz = $this->localBusinessSchema();
        $locBiz['name'] = 'Locksmiths.ie - ' . $location['name'];
        $locBiz['address']['addressLocality'] = $location['name'];
        if ($location['lat'] && $location['lng']) {
            $locBiz['geo']['latitude'] = $location['lat'];
            $locBiz['geo']['longitude'] = $location['lng'];
        }
        $schemas[0] = $locBiz;

        // Service schema for this location
        $schemas[] = $this->serviceSchema(
            'Locksmith Services in ' . $location['name'],
            'Professional 24/7 locksmith services in ' . $location['name'] . ', Dublin. Emergency lockouts, lock changes, car keys, and more.',
            SITE_URL . '/locksmiths-' . $location['slug']
        );

        if (!empty($location['faqs'])) {
            $schemas[] = $this->faqSchema($location['faqs']);
        }

        if (!empty($location['reviews'])) {
            $locBiz['review'] = $this->reviewSchema($location['reviews']);
            $schemas[0] = $locBiz;
        }

        $this->view('pages/location', [
            'pageTitle' => 'Locksmiths ' . $location['name'],
            'metaTitle' => $location['meta_title'],
            'metaDescription' => $location['meta_description'],
            'canonicalUrl' => SITE_URL . '/locksmiths-' . $location['slug'],
            'schemaMarkup' => $this->generateSchema($schemas),
            'location' => $location,
            'services' => $services,
            'nearby' => $location['nearby'] ?? [],
            'faqs' => $location['faqs'] ?? [],
            'reviews' => $location['reviews'] ?? [],
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => 'Dublin', 'url' => '/locksmiths-dublin'],
                ['name' => 'Locksmiths ' . $location['name']]
            ]
        ]);
    }
}
