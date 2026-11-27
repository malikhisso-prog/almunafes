<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/config.php';

$products = loadJson('products.json', []);
$activeProducts = array_values(array_filter($products, static fn($p) => !empty($p['active'])));

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$baseUrl = $protocol . $host . '/almunafes/';

$result = array_map(static function ($p) use ($baseUrl) {
    // إصلاح مسار الصورة
    $imgFile = $p['image'] ?? 'chest-press.jpg';
    
    // إزالة أي مسار مكرر
    $imgFile = preg_replace('#^(assets/images/products/)+#', '', $imgFile);
    
    // المسار النهائي الصحيح
    $finalImageUrl = $baseUrl . 'assets/images/products/' . $imgFile;

    return [
        'id' => $p['id'] ?? '',
        'name' => $p['name'] ?? '',
        'brand' => $p['brand'] ?? 'ALMUNAFES PRO',
        'category' => $p['category'] ?? 'أجهزة القوة',
        'price' => $p['price'] ?? 'تواصل للسعر',
        'shortDesc' => $p['short_description'] ?? '',
        'fullDesc' => $p['description'] ?? ($p['short_description'] ?? ''),
        'imageUrl' => $finalImageUrl,
    ];
}, $activeProducts);

echo json_encode($result, JSON_UNESCAPED_UNICODE);