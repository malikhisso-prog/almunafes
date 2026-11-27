<?php
require_once dirname(__DIR__) . '/config.php';

$pageTitle = $pageTitle ?? SITE_NAME;
$pageDescription = $pageDescription ?? 'المنافس لتجهيز الأندية الرياضية الاحترافية';
$currentPage = $currentPage ?? '';

$navItems = [
    'index' => ['label' => 'الرئيسية', 'url' => siteUrl('index.php')],
    'products' => ['label' => 'المنتجات', 'url' => siteUrl('products.php')],
    'brands' => ['label' => 'العلامات التجارية', 'url' => siteUrl('brands.php')],
    'solutions' => ['label' => 'الحلول', 'url' => siteUrl('solutions.php')],
    'about' => ['label' => 'من نحن', 'url' => siteUrl('about.php')],
    'contact' => ['label' => 'تواصل معنا', 'url' => siteUrl('contact.php')],
];
$v = time();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    
    <!-- تحميل خط Cairo بشكل صحيح -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- ملفات التنسيق -->
    <link rel="stylesheet" href="<?= e(rtrim(CSS_URL, '/') . '/style.css?v=' . $v) ?>">
    <link rel="stylesheet" href="<?= e(rtrim(CSS_URL, '/') . '/components.css?v=' . $v) ?>">
    <link rel="stylesheet" href="<?= e(rtrim(CSS_URL, '/') . '/forms.css?v=' . $v) ?>">
    <link rel="stylesheet" href="<?= e(rtrim(CSS_URL, '/') . '/layout.css?v=' . $v) ?>">
    
    <style>
        .site-header { position: sticky; top: 0; z-index: 9999; width: 100%; background: #1F1E1B; border-bottom: 1px solid rgba(242,169,0,.22); box-shadow: 0 4px 20px rgba(0,0,0,.25); }
        .site-header .header-container { width: min(1200px, calc(100% - 40px)); min-height: 82px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 24px; direction: rtl; }
        .site-header .site-logo { display: inline-flex; align-items: center; gap: 10px; color: #FFFFFF; font-family: 'Cairo', sans-serif; font-size: 22px; font-weight: 900; text-decoration: none; white-space: nowrap; }
        .site-header .logo-mark { width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; border-radius: 9px; background: #F2A900; color: #141311; font-size: 25px; font-weight: 900; }
        .site-header .main-nav { display: flex; align-items: center; justify-content: center; flex: 1; gap: clamp(12px, 2vw, 25px); }
        .site-header .main-nav a { position: relative; padding: 10px 0; color: rgba(255,255,255,.78); font-family: 'Cairo', sans-serif; font-size: 13.5px; font-weight: 700; text-decoration: none; white-space: nowrap; transition: .25s; }
        .site-header .main-nav a:hover, .site-header .main-nav a.active { color: #F2A900; font-weight: 800; }
        .site-header .main-nav a.active::after { content: ""; position: absolute; right: 0; bottom: 3px; width: 100%; height: 2.5px; background: #F2A900; border-radius: 2px; }
        .site-header .header-cta { display: inline-flex; align-items: center; justify-content: center; min-height: 44px; padding: 9px 20px; border-radius: 8px; background: #F2A900; color: #141311; font-family: 'Cairo', sans-serif; font-size: 12.5px; font-weight: 900; text-decoration: none; white-space: nowrap; transition: .3s; }
        .site-header .header-cta:hover { background: #FFBA1A; transform: translateY(-2px); }
        .menu-toggle { display: none; background: #2D2B27; color: #F2A900; border: 1px solid rgba(242,169,0,.3); border-radius: 8px; padding: 8px 12px; font-size: 20px; cursor: pointer; }
        @media (max-width: 900px) { .menu-toggle { display: block; } .site-header .main-nav { display: none; position: absolute; top: 82px; inset-inline: 0; background: #1F1E1B; flex-direction: column; padding: 20px; border-bottom: 1px solid rgba(242,169,0,.2); } .site-header .main-nav.open { display: flex; } }
    </style>
</head>
<body>
<header class="site-header">
    <div class="header-container">
        <a href="<?= e(siteUrl('index.php')) ?>" class="site-logo">
            <span class="logo-mark">م</span>
            <span><?= e(SITE_NAME) ?></span>
        </a>
        <nav class="main-nav" id="mainNav">
            <?php foreach ($navItems as $key => $item): ?>
                <a href="<?= e($item['url']) ?>" class="<?= $currentPage === $key ? 'active' : '' ?>"><?= e($item['label']) ?></a>
            <?php endforeach; ?>
        </nav>
        <a href="<?= e(siteUrl('quote.php')) ?>" class="header-cta">اطلب عرض سعر</a>
        <button type="button" class="menu-toggle" aria-label="القائمة" onclick="document.getElementById('mainNav').classList.toggle('open')">☰</button>
    </div>
</header>
<main>