<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

header('Content-Type: application/xml; charset=UTF-8');

$baseUrl = rtrim(SITE_URL, '/');

$pages = [
    '' => '1.0',
    '/products.php' => '0.9',
    '/brands.php' => '0.8',
    '/solutions.php' => '0.8',
    '/about.php' => '0.7',
    '/contact.php' => '0.7',
    '/quote.php' => '0.7',
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $path => $priority): ?>
    <url>
        <loc><?= htmlspecialchars($baseUrl . $path, ENT_XML1, 'UTF-8') ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority><?= $priority ?></priority>
    </url>
<?php endforeach; ?>
</urlset>