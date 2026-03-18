<?php
/**
 * Page Controller - Handles static pages (home, about, contact, etc.)
 */
class PageController extends Controller {

    public function home(): void {
        $serviceModel = new Service();
        $locationModel = new Location();
        $reviewModel = new Review();
        $faqModel = new Faq();

        $services = $serviceModel->getActive();
        $locations = $locationModel->getActive();
        $reviews = $reviewModel->getForPage('home', 0, 6);
        $faqs = $faqModel->getForPage('home', 0);

        $schemas = [
            $this->localBusinessSchema(),
            $this->faqSchema($faqs),
            $this->breadcrumbSchema([
                ['name' => 'Home', 'url' => SITE_URL]
            ]),
            [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => SITE_NAME,
                'url' => SITE_URL,
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => SITE_URL . '/search?q={search_term_string}',
                    'query-input' => 'required name=search_term_string'
                ]
            ]
        ];

        $localBiz = $this->localBusinessSchema();
        $localBiz['review'] = $this->reviewSchema($reviews);
        $schemas[0] = $localBiz;

        $this->view('pages/home', [
            'pageTitle' => 'Locksmiths.ie - Ireland\'s #1 24/7 Locksmith Service',
            'metaTitle' => 'Locksmiths Dublin & Ireland | 24/7 Emergency Locksmith Service | Locksmiths.ie',
            'metaDescription' => 'Ireland\'s highest-rated locksmith service. 24/7 emergency locksmiths in Dublin & nationwide. Car keys, lock changes, CCTV, access control. Call now for 30-min response!',
            'canonicalUrl' => SITE_URL,
            'schemaMarkup' => $this->generateSchema($schemas),
            'heroTitle' => 'Ireland\'s Most Trusted Locksmith Service',
            'heroSubtitle' => '24/7 Emergency Locksmiths Across Dublin & Ireland — 30 Minute Response',
            'services' => $services,
            'locations' => $locations,
            'reviews' => $reviews,
            'faqs' => $faqs,
            'breadcrumbs' => [['name' => 'Home']]
        ]);
    }

    public function about(): void {
        $schemas = [
            $this->localBusinessSchema(),
            $this->breadcrumbSchema([
                ['name' => 'Home', 'url' => SITE_URL],
                ['name' => 'About Us']
            ])
        ];

        $this->view('pages/about', [
            'pageTitle' => 'About Us',
            'metaTitle' => 'About Locksmiths.ie | 20+ Years Experience | Ireland\'s Top Locksmith',
            'metaDescription' => 'Learn about Locksmiths.ie - Ireland\'s highest-rated locksmith company with 20+ years experience. Fully insured, certified professionals serving Dublin & all of Ireland.',
            'canonicalUrl' => SITE_URL . '/about',
            'schemaMarkup' => $this->generateSchema($schemas),
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => 'About Us']
            ]
        ]);
    }

    public function contact(): void {
        $schemas = [
            $this->localBusinessSchema(),
            $this->breadcrumbSchema([
                ['name' => 'Home', 'url' => SITE_URL],
                ['name' => 'Contact Us']
            ])
        ];

        $this->view('pages/contact', [
            'pageTitle' => 'Contact Us',
            'metaTitle' => 'Contact Locksmiths.ie | Call 24/7 | Dublin & Ireland',
            'metaDescription' => 'Contact Locksmiths.ie for emergency locksmith services across Dublin & Ireland. Available 24/7. Call now or fill out our contact form for a free quote.',
            'canonicalUrl' => SITE_URL . '/contact',
            'schemaMarkup' => $this->generateSchema($schemas),
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => 'Contact Us']
            ]
        ]);
    }

    public function privacy(): void {
        $this->view('pages/privacy', [
            'pageTitle' => 'Privacy Policy',
            'metaTitle' => 'Privacy Policy | Locksmiths.ie',
            'metaDescription' => 'Read our privacy policy to understand how Locksmiths.ie collects, uses, and protects your personal information.',
            'canonicalUrl' => SITE_URL . '/privacy-policy',
            'schemaMarkup' => '',
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => 'Privacy Policy']
            ]
        ]);
    }

    public function terms(): void {
        $this->view('pages/terms', [
            'pageTitle' => 'Terms & Conditions',
            'metaTitle' => 'Terms & Conditions | Locksmiths.ie',
            'metaDescription' => 'Terms and conditions for using Locksmiths.ie services. Read our terms of service, liability, and usage policies.',
            'canonicalUrl' => SITE_URL . '/terms',
            'schemaMarkup' => '',
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => 'Terms & Conditions']
            ]
        ]);
    }

    public function notFound(): void {
        $this->view('pages/404', [
            'pageTitle' => 'Page Not Found',
            'metaTitle' => '404 - Page Not Found | Locksmiths.ie',
            'metaDescription' => '',
            'canonicalUrl' => SITE_URL,
            'schemaMarkup' => '',
            'breadcrumbs' => [
                ['name' => 'Home', 'url' => '/'],
                ['name' => '404']
            ]
        ]);
    }
}
