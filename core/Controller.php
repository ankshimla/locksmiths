<?php
/**
 * Base Controller - All controllers extend this
 */
class Controller {
    protected function view(string $template, array $data = []): void {
        extract($data);
        $content = $this->renderPartial($template, $data);
        require __DIR__ . '/../app/views/layouts/main.php';
    }

    protected function renderPartial(string $template, array $data = []): string {
        extract($data);
        ob_start();
        require __DIR__ . '/../app/views/' . $template . '.php';
        return ob_get_clean();
    }

    protected function json(array $data, int $code = 200): void {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect(string $url): void {
        header('Location: ' . $url);
        exit;
    }

    protected function generateSchema(array $schemas): string {
        $output = '';
        foreach ($schemas as $schema) {
            $output .= '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
        }
        return $output;
    }

    protected function localBusinessSchema(): array {
        return [
            '@context' => 'https://schema.org',
            '@type' => ['Locksmith', 'LocalBusiness'],
            'name' => SITE_NAME,
            'url' => SITE_URL,
            'telephone' => SITE_PHONE,
            'email' => SITE_EMAIL,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Dublin',
                'addressRegion' => 'County Dublin',
                'addressCountry' => 'IE'
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => '53.3498',
                'longitude' => '-6.2603'
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
                'opens' => '00:00',
                'closes' => '23:59'
            ],
            'priceRange' => '€€',
            'image' => SITE_URL . '/public/images/logo.png',
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Ireland'
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'reviewCount' => '387',
                'bestRating' => '5'
            ]
        ];
    }

    protected function breadcrumbSchema(array $items): array {
        $list = [];
        foreach ($items as $i => $item) {
            $list[] = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
                'item' => $item['url'] ?? null
            ];
        }
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $list
        ];
    }

    protected function faqSchema(array $faqs): array {
        $items = [];
        foreach ($faqs as $faq) {
            $items[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                ]
            ];
        }
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $items
        ];
    }

    protected function serviceSchema(string $name, string $description, string $url): array {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $name,
            'description' => $description,
            'url' => $url,
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => SITE_NAME,
                'telephone' => SITE_PHONE
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Ireland'
            ]
        ];
    }

    protected function reviewSchema(array $reviews): array {
        $items = [];
        foreach ($reviews as $review) {
            $items[] = [
                '@type' => 'Review',
                'author' => ['@type' => 'Person', 'name' => $review['name']],
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => $review['rating'],
                    'bestRating' => '5'
                ],
                'reviewBody' => $review['text'],
                'datePublished' => $review['date'] ?? '2025-01-15'
            ];
        }
        return $items;
    }
}
