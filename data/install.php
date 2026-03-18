<?php
/**
 * Database Installer - Creates MySQL tables and seeds initial data
 * Locksmiths.ie CMS
 */

function installDatabase(): void {
    $db = getDB();

    // Create tables
    $db->exec("
        CREATE TABLE IF NOT EXISTS services (
            id INT AUTO_INCREMENT PRIMARY KEY,
            slug VARCHAR(255) UNIQUE NOT NULL,
            title VARCHAR(255) NOT NULL,
            meta_title VARCHAR(255),
            meta_description TEXT,
            hero_heading VARCHAR(255),
            hero_subheading VARCHAR(255),
            content TEXT,
            icon VARCHAR(100),
            sort_order INT DEFAULT 0,
            active TINYINT DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS locations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            slug VARCHAR(255) UNIQUE NOT NULL,
            name VARCHAR(255) NOT NULL,
            county VARCHAR(255),
            meta_title VARCHAR(255),
            meta_description TEXT,
            content TEXT,
            lat DOUBLE,
            lng DOUBLE,
            phone VARCHAR(50),
            active TINYINT DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS brands (
            id INT AUTO_INCREMENT PRIMARY KEY,
            slug VARCHAR(255) UNIQUE NOT NULL,
            name VARCHAR(255) NOT NULL,
            meta_title VARCHAR(255),
            meta_description TEXT,
            content TEXT,
            logo_url VARCHAR(500),
            active TINYINT DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS blog_posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            slug VARCHAR(255) UNIQUE NOT NULL,
            title VARCHAR(255) NOT NULL,
            meta_title VARCHAR(255),
            meta_description TEXT,
            excerpt TEXT,
            content TEXT,
            author VARCHAR(255) DEFAULT 'Locksmiths.ie',
            featured_image VARCHAR(500),
            published TINYINT DEFAULT 0,
            published_at DATETIME,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS faqs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            question TEXT NOT NULL,
            answer TEXT NOT NULL,
            service_id INT,
            sort_order INT DEFAULT 0,
            active TINYINT DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_name VARCHAR(255) NOT NULL,
            rating INT DEFAULT 5,
            review_text TEXT,
            service_id INT,
            location_id INT,
            approved TINYINT DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL,
            FOREIGN KEY (location_id) REFERENCES locations(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS quotes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(50),
            service VARCHAR(255),
            location VARCHAR(255),
            message TEXT,
            status VARCHAR(50) DEFAULT 'new',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS settings (
            setting_key VARCHAR(255) PRIMARY KEY,
            setting_value TEXT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");

    // Seed services
    $services = [
        ['locksmiths', 'Locksmiths', 'Professional Locksmith Services Ireland | Locksmiths.ie', 'Expert locksmith services across Ireland. Lock changes, repairs, installations for residential and commercial properties.', 'Professional Locksmith Services', 'Trusted locksmiths across Ireland', 'lock'],
        ['auto-locksmiths', 'Auto Locksmiths', 'Auto Locksmith Ireland | Car Key Specialists | Locksmiths.ie', 'Expert auto locksmith services. Car lockouts, key cutting, transponder programming for all vehicle makes.', 'Auto Locksmith Services', 'Car key specialists across Ireland', 'car'],
        ['emergency-locksmiths', 'Emergency Locksmiths', '24/7 Emergency Locksmith Ireland | Fast Response | Locksmiths.ie', 'Emergency locksmith available 24/7. Fast response times for lockouts, break-in repairs, and urgent lock changes.', '24/7 Emergency Locksmith', 'Fast response when you need it most', 'alert'],
        ['master-key-systems', 'Master Key Systems', 'Master Key Systems Ireland | Commercial Security | Locksmiths.ie', 'Professional master key system design and installation for businesses, offices, and apartment complexes.', 'Master Key Systems', 'Complete access control for your property', 'key'],
        ['transponder-keys-ireland', 'Transponder Keys', 'Transponder Key Programming Ireland | Locksmiths.ie', 'Transponder key cutting and programming for all major car brands. Mobile service available.', 'Transponder Key Services', 'Programming for all vehicle makes', 'cpu'],
        ['cctv-installation', 'CCTV Installation', 'CCTV Installation Ireland | Security Cameras | Locksmiths.ie', 'Professional CCTV installation for homes and businesses. HD cameras, remote viewing, and expert setup.', 'CCTV Installation', 'Protect your property with professional CCTV', 'camera'],
        ['safes-locksmiths', 'Safes', 'Safe Opening & Installation Ireland | Locksmiths.ie', 'Safe opening, repairs, and installation. Fire-resistant and security safes for home and business.', 'Safe Services', 'Opening, repair, and installation', 'shield'],
        ['access-control-systems', 'Access Control Systems', 'Access Control Systems Ireland | Locksmiths.ie', 'Modern access control systems for commercial properties. Keypad, card, and biometric solutions.', 'Access Control Systems', 'Modern security for your business', 'fingerprint'],
        ['car-keys-dublin', 'Car Keys Dublin', 'Car Keys Dublin | Replacement & Spare Keys | Locksmiths.ie', 'Car key replacement and spare keys in Dublin. All makes and models. Mobile service available.', 'Car Keys Dublin', 'Replacement keys for all vehicle makes', 'car'],
        ['slam-locks-vans', 'Slam Locks for Vans', 'Slam Locks for Vans Ireland | Van Security | Locksmiths.ie', 'Slam lock installation for vans and commercial vehicles. Protect your tools and stock.', 'Slam Locks for Vans', 'Automatic security for your commercial vehicle', 'truck'],
        ['emergency-callout', 'Emergency Callout', '24/7 Emergency Locksmith Callout | Locksmiths.ie', 'Emergency locksmith callout service available 24 hours a day, 7 days a week across Ireland.', '24/7 Emergency Callout', 'We come to you, day or night', 'phone'],
    ];

    $stmt = $db->prepare("INSERT IGNORE INTO services (slug, title, meta_title, meta_description, hero_heading, hero_subheading, icon, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($services as $i => $s) {
        $stmt->execute([$s[0], $s[1], $s[2], $s[3], $s[4], $s[5], $s[6], $i]);
    }

    // Seed locations - Dublin suburbs + major cities
    $locations = [
        ['dublin', 'Dublin', 'Dublin', 'Locksmiths Dublin | 24/7 Emergency Locksmith | Locksmiths.ie', 'Professional locksmith services in Dublin. Emergency lockouts, lock changes, car keys. Fast response across Dublin city and county.', 53.3498, -6.2603],
        ['swords', 'Swords', 'Dublin', 'Locksmiths Swords | 24/7 Emergency Locksmith | Locksmiths.ie', 'Fast emergency locksmith services in Swords, North Dublin. Lock changes, car keys, CCTV installation. 30 minute response.', 53.4597, -6.2181],
        ['lucan', 'Lucan', 'Dublin', 'Locksmiths Lucan | 24/7 Emergency Locksmith | Locksmiths.ie', 'Trusted locksmith services in Lucan, West Dublin. Emergency lockouts, lock repairs, key cutting. Available 24/7.', 53.3564, -6.4497],
        ['blanchardstown', 'Blanchardstown', 'Dublin', 'Locksmiths Blanchardstown | 24/7 Locksmith | Locksmiths.ie', 'Expert locksmith services in Blanchardstown, Dublin 15. Emergency response, lock changes, car key replacement.', 53.3888, -6.3756],
        ['tallaght', 'Tallaght', 'Dublin', 'Locksmiths Tallaght | Emergency Locksmith | Locksmiths.ie', 'Reliable locksmith services in Tallaght, South Dublin. 24/7 emergency callouts, lock installations, car keys.', 53.2876, -6.3542],
        ['dundrum', 'Dundrum', 'Dublin', 'Locksmiths Dundrum | 24/7 Locksmith Services | Locksmiths.ie', 'Professional locksmith services in Dundrum, Dublin 14. Emergency lockouts, lock upgrades, security solutions.', 53.2922, -6.2458],
        ['dun-laoghaire', 'Dun Laoghaire', 'Dublin', 'Locksmiths Dun Laoghaire | Emergency Locksmith | Locksmiths.ie', 'Expert locksmith services in Dun Laoghaire. Emergency lockouts, residential and commercial lock services. Fast response.', 53.2945, -6.1348],
        ['rathmines', 'Rathmines', 'Dublin', 'Locksmiths Rathmines | 24/7 Locksmith | Locksmiths.ie', 'Trusted locksmith services in Rathmines, Dublin 6. Emergency lockouts, lock changes, key cutting, CCTV.', 53.3224, -6.2632],
        ['cork', 'Cork', 'Cork', 'Locksmiths Cork | 24/7 Locksmith Services | Locksmiths.ie', 'Expert locksmith services in Cork. Emergency callouts, lock repairs, car key replacement across Cork city and county.', 51.8985, -8.4756],
        ['galway', 'Galway', 'Galway', 'Locksmiths Galway | Emergency Locksmith | Locksmiths.ie', 'Reliable locksmith services in Galway. 24/7 emergency response, lock installations, and car key services.', 53.2707, -9.0568],
        ['limerick', 'Limerick', 'Limerick', 'Locksmiths Limerick | 24/7 Locksmith | Locksmiths.ie', 'Professional locksmith services in Limerick. Fast emergency response, residential and commercial services.', 52.6638, -8.6267],
        ['waterford', 'Waterford', 'Waterford', 'Locksmiths Waterford | Lock & Key Services | Locksmiths.ie', 'Trusted locksmith services in Waterford. Emergency lockouts, car keys, and commercial security solutions.', 52.2593, -7.1101],
        ['kilkenny', 'Kilkenny', 'Kilkenny', 'Locksmiths Kilkenny | Emergency Locksmith | Locksmiths.ie', 'Expert locksmith services in Kilkenny. 24/7 emergency callouts, lock changes, and security upgrades.', 52.6541, -7.2448],
        ['kildare', 'Kildare', 'Kildare', 'Locksmiths Kildare | 24/7 Locksmith Services | Locksmiths.ie', 'Professional locksmith services across County Kildare. Emergency response, lock repairs, car key cutting.', 53.1589, -6.9096],
        ['meath', 'Meath', 'Meath', 'Locksmiths Meath | Emergency Locksmith | Locksmiths.ie', 'Reliable locksmith services in County Meath. 24/7 emergency lockouts, lock installations, and car keys.', 53.6055, -6.6564],
        ['wicklow', 'Wicklow', 'Wicklow', 'Locksmiths Wicklow | Lock & Key Services | Locksmiths.ie', 'Trusted locksmith services in Wicklow. Emergency callouts, residential and commercial lock services.', 52.9808, -6.0446],
        ['wexford', 'Wexford', 'Wexford', 'Locksmiths Wexford | 24/7 Locksmith | Locksmiths.ie', 'Professional locksmith services in Wexford. Emergency lockouts, lock changes, and key cutting services.', 52.3369, -6.4633],
    ];

    $stmt = $db->prepare("INSERT IGNORE INTO locations (slug, name, county, meta_title, meta_description, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($locations as $l) {
        $stmt->execute($l);
    }

    // Seed car brands
    $brands = [
        ['toyota', 'Toyota'], ['volkswagen', 'Volkswagen'], ['ford', 'Ford'], ['bmw', 'BMW'],
        ['audi', 'Audi'], ['mercedes', 'Mercedes-Benz'], ['hyundai', 'Hyundai'], ['kia', 'Kia'],
        ['nissan', 'Nissan'], ['peugeot', 'Peugeot'], ['renault', 'Renault'], ['skoda', 'Skoda'],
        ['opel', 'Opel'], ['honda', 'Honda'], ['mazda', 'Mazda'], ['volvo', 'Volvo'],
        ['land-rover', 'Land Rover'], ['jaguar', 'Jaguar'], ['mini', 'Mini'], ['fiat', 'Fiat'],
    ];

    $stmt = $db->prepare("INSERT IGNORE INTO brands (slug, name, meta_title, meta_description) VALUES (?, ?, ?, ?)");
    foreach ($brands as $b) {
        $stmt->execute([
            $b[0], $b[1],
            "Auto Locksmith {$b[1]} Ireland | Car Key Replacement | Locksmiths.ie",
            "{$b[1]} car key replacement, spare keys, and transponder programming. Expert auto locksmith for all {$b[1]} models across Ireland."
        ]);
    }

    // Seed FAQs
    $faqs = [
        ['How quickly can a locksmith arrive?', 'Our emergency locksmiths typically arrive within 20-30 minutes in urban areas. Response times may vary in rural locations, but we always aim to reach you as fast as possible.'],
        ['How much does an emergency locksmith cost?', 'Emergency callout fees vary depending on the service required, time of day, and location. We provide transparent pricing with no hidden fees. Call us for a free quote.'],
        ['Can you make car keys without the original?', 'Yes, our auto locksmiths can cut and program new car keys even if you have lost all your original keys. We cover all major vehicle brands.'],
        ['Do you provide commercial locksmith services?', 'Yes, we offer full commercial locksmith services including master key systems, access control, CCTV installation, and high-security lock installations for businesses.'],
        ['Are your locksmiths insured and certified?', 'All our locksmiths are fully insured, Garda vetted, and hold relevant industry certifications. We are members of the Associated Locksmiths of Ireland.'],
        ['Do you install smart locks?', 'Yes, we supply and install a range of smart locks and digital lock systems for both residential and commercial properties.'],
    ];

    $stmt = $db->prepare("INSERT IGNORE INTO faqs (question, answer, sort_order) VALUES (?, ?, ?)");
    foreach ($faqs as $i => $f) {
        $stmt->execute([$f[0], $f[1], $i]);
    }

    // Seed reviews
    $reviews = [
        ['Sarah M.', 5, 'Locked out at midnight and they arrived in 25 minutes. Professional and friendly. Highly recommend!'],
        ['James O.', 5, 'Had all my car keys replaced after losing them. Great service and fair pricing.'],
        ['Mary K.', 5, 'Installed a master key system in our office building. Excellent work and very knowledgeable.'],
        ['Tom B.', 5, 'CCTV installation was quick and professional. The team explained everything clearly.'],
        ['Emma D.', 4, 'Great emergency service. New lock fitted quickly after a break-in. Felt safe again right away.'],
        ['Patrick R.', 5, 'Used them for slam locks on our delivery vans. Top quality work and competitive prices.'],
    ];

    $stmt = $db->prepare("INSERT IGNORE INTO reviews (customer_name, rating, review_text, approved) VALUES (?, ?, ?, 1)");
    foreach ($reviews as $r) {
        $stmt->execute([$r[0], $r[1], $r[2]]);
    }

    // Seed settings
    $settings = [
        ['site_name', 'Locksmiths.ie'],
        ['site_tagline', "Ireland's #1 24/7 Locksmith Service"],
        ['site_phone', '01 234 5678'],
        ['site_email', 'info@locksmiths.ie'],
        ['site_address', 'Dublin, Ireland'],
        ['google_analytics', ''],
        ['social_facebook', 'https://facebook.com/locksmithsie'],
        ['social_instagram', 'https://instagram.com/locksmithsie'],
        ['social_twitter', 'https://twitter.com/locksmithsie'],
    ];

    $stmt = $db->prepare("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES (?, ?)");
    foreach ($settings as $s) {
        $stmt->execute($s);
    }

    // Seed a blog post
    $db->exec("INSERT IGNORE INTO blog_posts (slug, title, meta_title, meta_description, excerpt, content, published, published_at) VALUES (
        'home-security-tips-ireland',
        '10 Home Security Tips Every Irish Homeowner Should Know',
        '10 Home Security Tips | Locksmiths.ie Blog',
        'Essential home security tips for Irish homeowners. Protect your home with these expert locksmith recommendations.',
        'Discover the top 10 home security measures recommended by professional locksmiths to keep your Irish home safe and secure.',
        '<h2>Protect Your Home with Expert Advice</h2><p>As professional locksmiths serving Ireland for over 20 years, we have seen it all. Here are our top recommendations for keeping your home secure.</p><h3>1. Upgrade Your Locks</h3><p>Many Irish homes still have outdated cylinder locks that can be easily bypassed. Consider upgrading to anti-snap, anti-pick, and anti-bump cylinders.</p><h3>2. Install a Deadbolt</h3><p>A quality deadbolt on your front and back doors provides an extra layer of security that is difficult to defeat.</p><h3>3. Secure Your Windows</h3><p>Window locks are often overlooked but are a common entry point for burglars. Ensure all windows have functioning locks.</p><h3>4. Consider CCTV</h3><p>Modern CCTV systems are affordable and can be monitored from your smartphone. A visible camera is also an excellent deterrent.</p><h3>5. Use Timer Switches</h3><p>When away, use timer switches on lights and radios to give the impression someone is home.</p>',
        1,
        NOW()
    )");
}
