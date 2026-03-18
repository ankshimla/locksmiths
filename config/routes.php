<?php
/**
 * Route definitions - Maps URL patterns to controllers
 */
return [
    // Static pages
    '/' => ['controller' => 'PageController', 'action' => 'home'],
    '/about' => ['controller' => 'PageController', 'action' => 'about'],
    '/contact' => ['controller' => 'PageController', 'action' => 'contact'],
    '/privacy-policy' => ['controller' => 'PageController', 'action' => 'privacy'],
    '/terms' => ['controller' => 'PageController', 'action' => 'terms'],
    '/blog' => ['controller' => 'BlogController', 'action' => 'index'],

    // Services
    '/locksmiths' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'locksmiths']],
    '/auto-locksmiths' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'auto-locksmiths']],
    '/emergency-locksmiths' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'emergency-locksmiths']],
    '/master-key-systems' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'master-key-systems']],
    '/transponder-keys-ireland' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'transponder-keys-ireland']],
    '/cctv-installation' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'cctv-installation']],
    '/safes-locksmiths' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'safes-locksmiths']],
    '/access-control-systems' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'access-control-systems']],
    '/car-keys-dublin' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'car-keys-dublin']],
    '/slam-locks-vans' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'slam-locks-vans']],
    '/emergency-callout' => ['controller' => 'ServiceController', 'action' => 'show', 'params' => ['slug' => 'emergency-callout']],

    // Dynamic routes (patterns)
    '/locksmiths-{location}' => ['controller' => 'LocationController', 'action' => 'show'],
    '/auto-locksmith-{brand}' => ['controller' => 'BrandController', 'action' => 'show'],
    '/blog/{slug}' => ['controller' => 'BlogController', 'action' => 'show'],

    // API / AJAX
    '/api/quote' => ['controller' => 'ApiController', 'action' => 'quote'],
    '/api/contact' => ['controller' => 'ApiController', 'action' => 'contact'],

    // Sitemap
    '/sitemap.xml' => ['controller' => 'SitemapController', 'action' => 'index'],
];
