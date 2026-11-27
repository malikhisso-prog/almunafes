<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'الرئيسية | المنافس لتجهيز الأندية الرياضية';
$pageDescription = 'حلول متكاملة لتجهيز الأندية الرياضية ومراكز اللياقة بأجهزة احترافية تجمع بين الجودة والأداء والتصميم.';
$currentPage = 'index';

$products = loadJson('products.json', []);
$brands = loadJson('brands.json', []);
$featuredProducts = array_slice(array_filter($products, static fn($p) => !empty($p['active'])), 0, 6);

$heroMain = [
    'eyebrow' => 'EQUIP YOUR AMBITION',
    'title' => 'نجهّز طموحك،<br>ونصنع فرقاً',
    'description' => 'حلول متكاملة لتجهيز الأندية الرياضية بأجهزة احترافية تجمع بين الجودة والأداء والتصميم.',
    'image' => imageUrl('hero/hero-main.jpg')
];

$homeCategories = [
    ['name' => 'أجهزة الكارديو', 'slug' => 'cardio', 'description' => 'أجهزة المشي والدراجات والأجهزة البيضاوية', 'image' => imageUrl('products/treadmill.jpg')],
    ['name' => 'أجهزة القوة', 'slug' => 'strength', 'description' => 'أجهزة المقاومة وتمارين العضلات', 'image' => imageUrl('products/chest-press.jpg')],
    ['name' => 'الأوزان الحرة', 'slug' => 'free-weights', 'description' => 'دمبل وبارات وأقراص وأوزان احترافية', 'image' => imageUrl('products/dumbbells.jpg')],
    ['name' => 'التدريب الوظيفي', 'slug' => 'functional', 'description' => 'معدات التدريب المتنوع واللياقة البدنية', 'image' => imageUrl('products/adjustable-bench.jpg')],
];

$projects = [
    ['title' => 'تجهيز الأندية الرياضية', 'description' => 'حلول متكاملة للأندية الكبيرة والصغيرة بأعلى معايير المتانة.', 'image' => imageUrl('products/chest-press.jpg')],
    ['title' => 'مساحات تدريب احترافية', 'description' => 'معدات متنوعة وتخطيط مدروس لتجربة تدريب متكاملة.', 'image' => imageUrl('products/exercise-bike.jpg')],
    ['title' => 'مراكز اللياقة البدنية', 'description' => 'تجهيزات عصرية تناسب مختلف المساحات والاحتياجات.', 'image' => imageUrl('products/lat-pulldown.jpg')]
];

$tickerItems = [
    'أجهزة رياضية تجارية معتمدة',
    'تجهيز متكامل للأندية ومراكز اللياقة',
    'علامات تجارية عالمية موثوقة',
    'تخطيط وتوزيع احترافي للمساحات',
    'ضمان شامل وتوفير قطع الغيار',
    'توريد وتركيب بأيدي خبراء',
    'متانة عالية تتحمل الاستخدام المكثف',
    'تصاميم عصرية ترتقي بمستوى ناديك',
];

$dumbbellSvg = '<svg width="30" height="16" viewBox="0 0 28 14" fill="#1F1E1B" style="margin-left:12px; flex-shrink:0;" xmlns="http://w3.org"><rect x="0" y="3" width="2.5" height="8" rx="1"/><rect x="3.5" y="1" width="3" height="12" rx="1"/><rect x="7" y="5.5" width="14" height="3"/><rect x="21.5" y="1" width="3" height="12" rx="1"/><rect x="25.5" y="3" width="2.5" height="8" rx="1"/></svg>';

require_once ROOT_PATH . '/includes/header.php';
?>
<link rel="stylesheet" href="<?= e(rtrim(CSS_URL, '/') . '/home.css?v=' . time()) ?>">

<div class="home-page">
    <section class="home-hero">
        <div class="home-hero-slide">
            <img src="<?= e($heroMain['image']) ?>" alt="أجهزة رياضية احترافية" fetchpriority="high">
            <div class="home-hero-overlay"></div>
        </div>
        <div class="home-container home-hero-content">
            <div class="home-hero-eyebrow"><?= e($heroMain['eyebrow']) ?></div>
            <h1><?= $heroMain['title'] ?></h1>
            <p><?= e($heroMain['description']) ?></p>
            <div class="home-hero-actions">
                <a href="<?= e(siteUrl('products.php')) ?>" class="home-btn home-btn-primary">اكتشف منتجاتنا <span>←</span></a>
                <a href="<?= e(siteUrl('contact.php')) ?>" class="home-btn home-btn-outline">تواصل معنا</a>
            </div>
        </div>
        <div class="home-container home-hero-bottom">
            <div class="home-hero-scroll">SCROLL TO EXPLORE ↓</div>
        </div>
    </section>

    <div class="home-ticker" aria-hidden="true">
        <div class="home-ticker-track">
            <?php for ($loop = 0; $loop < 2; $loop++): ?>
                <div class="home-ticker-group">
                    <?php foreach ($tickerItems as $text): ?>
                        <span style="display:inline-flex; align-items:center; color:#141311; font-weight:900;">
                            <?= $dumbbellSvg ?>
                            <?= e($text) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <section class="home-stats">
        <div class="home-container home-stats-grid">
            <div class="home-stat-item"><span class="home-stat-number">01</span><span class="home-stat-label">جودة نحرص عليها</span></div>
            <div class="home-stat-item"><span class="home-stat-number">02</span><span class="home-stat-label">معدات احترافية</span></div>
            <div class="home-stat-item"><span class="home-stat-number">03</span><span class="home-stat-label">حلول متكاملة</span></div>
            <div class="home-stat-item"><span class="home-stat-number">04</span><span class="home-stat-label">خدمة موجهة للأندية</span></div>
        </div>
    </section>

    <section class="home-section home-intro-sec">
        <div class="home-container home-intro-grid">
            <div class="home-intro-stage">
                <div class="home-intro-glow"></div>
                <img class="home-intro-image" src="<?= e(imageUrl('products/leg-press.jpg')) ?>" alt="جهاز رياضي احترافي" loading="lazy">
                <div class="home-intro-badge"><span>★</span> معدات تجارية معتمدة</div>
            </div>
            <div class="home-intro-content">
                <span class="home-kicker">WHO WE ARE</span>
                <h2>أكثر من مجرد أجهزة، <span>نحن شريك نجاحك</span></h2>
                <p>في المنافس، نؤمن أن النادي الرياضي الناجح يبدأ من اختيار المعدات المناسبة. نوفر حلولاً لتجهيز الأندية ومراكز اللياقة بمعدات رياضية تجارية احترافية تلبي احتياجات مختلف المشاريع.</p>
                <div class="home-intro-points">
                    <div class="home-intro-point"><span class="home-intro-check">✓</span> أجهزة رياضية تجارية احترافية</div>
                    <div class="home-intro-point"><span class="home-intro-check">✓</span> خيارات متنوعة لمختلف أحجام الأندية</div>
                    <div class="home-intro-point"><span class="home-intro-check">✓</span> المساعدة في اختيار التجهيزات المناسبة</div>
                </div>
                <a href="<?= e(siteUrl('about.php')) ?>" class="home-btn home-btn-primary">تعرف علينا <span>←</span></a>
            </div>
        </div>
    </section>

    <section class="home-section home-categories">
        <div class="home-container">
            <div class="home-section-heading">
                <div><span class="home-kicker">OUR CATEGORIES</span><h2>اكتشف عالم تجهيزاتنا</h2><p>كل ما يحتاجه ناديك الرياضي في مكان واحد.</p></div>
                <a href="<?= e(siteUrl('products.php')) ?>" class="home-link">جميع المنتجات ←</a>
            </div>
            <div class="home-category-grid">
                <?php foreach ($homeCategories as $category): ?>
                    <a href="<?= e(siteUrl('products.php?category=' . urlencode($category['slug']))) ?>" class="home-category-card">
                        <img src="<?= e($category['image']) ?>" alt="<?= e($category['name']) ?>" loading="lazy">
                        <div class="home-category-info">
                            <h3><?= e($category['name']) ?></h3>
                            <p><?= e($category['description']) ?></p>
                            <span class="home-category-more">استكشف الفئة <span>←</span></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="home-section">
        <div class="home-container">
            <div class="home-section-heading">
                <div><span class="home-kicker">FEATURED EQUIPMENT</span><h2>مختارات من أجهزتنا</h2><p>أحدث المعدات الرياضية المصممة للاستخدام المكثف والأداء العالي.</p></div>
                <a href="<?= e(siteUrl('products.php')) ?>" class="home-link">عرض الكل ←</a>
            </div>
            <div class="home-product-grid">
                <?php foreach ($featuredProducts as $item): ?>
                    <article class="home-product-showcase">
                        <div class="home-product-image"><img src="<?= e(imageUrl('products/' . ($item['image'] ?? 'chest-press.jpg'))) ?>" alt="<?= e($item['name'] ?? '') ?>" loading="lazy"></div>
                        <div class="home-product-content">
                            <?php if (!empty($item['brand'])): ?><span class="home-product-tag"><?= e($item['brand']) ?></span><?php endif; ?>
                            <h3><?= e($item['name'] ?? '') ?></h3>
                            <p><?= e($item['short_description'] ?? $item['description'] ?? '') ?></p>
                            <a href="<?= e(siteUrl('product.php?slug=' . urlencode($item['slug'] ?? ''))) ?>" class="home-link">تفاصيل الجهاز ←</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="home-section home-brands">
        <div class="home-container">
            <div class="home-section-heading">
                <div><span class="home-kicker">TRUSTED BRANDS</span><h2>علامات تجارية عالمية</h2><p>نتعاون مع أبرز المصنعين لتوفير معدات موثوقة تدوم طويلاً.</p></div>
                <a href="<?= e(siteUrl('brands.php')) ?>" class="home-link">جميع العلامات ←</a>
            </div>
            <div class="home-brand-grid">
                <?php foreach (array_slice($brands, 0, 8) as $brand): ?>
                    <div class="home-brand-item"><?= e(is_array($brand) ? ($brand['name'] ?? 'BRAND') : $brand) ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="home-section home-projects">
        <div class="home-container">
            <div class="home-section-heading">
