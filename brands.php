<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'العلامات التجارية | المنافس لتجهيز الأندية الرياضية';
$pageDescription = 'اكتشف العلامات التجارية العالمية للمعدات الرياضية الاحترافية التي توفرها شركة المنافس لتجهيز الأندية ومراكز اللياقة.';
$currentPage = 'brands';

$brandsData = loadJson('brands.json', []);
$activeBrands = array_values(array_filter($brandsData, static fn($b) => !empty($b['active'])));

$brandCoverImages = [
    imageUrl('hero/hero-main.jpg'),
    imageUrl('products/chest-press.jpg'),
    imageUrl('products/treadmill.jpg'),
    imageUrl('products/leg-press.jpg'),
    imageUrl('products/dumbbells.jpg'),
    imageUrl('products/lat-pulldown.jpg'),
];

require_once ROOT_PATH . '/includes/header.php';
?>
<style>
.brand-badge-header {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 18px;
    background: #141311;
    color: #F2A900;
    font-size: 15px;
    font-weight: 900;
    letter-spacing: 1px;
    border-radius: 8px;
    margin-bottom: 14px;
    border: 1px solid rgba(242, 169, 0, 0.35);
}
</style>

<section class="page-banner">
    <div class="container">
        <span class="section-eyebrow">OUR BRANDS</span>
        <h1>العلامات التجارية</h1>
        <p>نتعاون مع نخبة من العلامات التجارية العالمية لتوفير معدات رياضية احترافية تجمع بين المتانة والأداء العالي.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="brands-page-grid">
            <?php if (!empty($activeBrands)): ?>
                <?php foreach ($activeBrands as $index => $brand): ?>
                    <?php
                        $coverImg = $brandCoverImages[$index % count($brandCoverImages)];
                        $brandName = is_array($brand) ? ($brand['name'] ?? 'Brand') : $brand;
                        $brandDesc = is_array($brand) ? ($brand['description'] ?? 'علامة تجارية متخصصة في تصنيع المعدات الرياضية الاحترافية للأندية ومراكز اللياقة.') : '';
                        $brandCountry = is_array($brand) ? ($brand['country'] ?? 'معتمد عالمياً') : 'معتمد عالمياً';
                    ?>
                    <article class="brand-card">
                        <div class="brand-card-image">
                            <img src="<?= e($coverImg) ?>" alt="<?= e($brandName) ?>" loading="lazy">
                        </div>
                        <div class="brand-card-content">
                            <div class="brand-badge-header"><?= e($brandName) ?></div>
                            <h3><?= e($brandName) ?></h3>
                            <p><?= e($brandDesc) ?></p>
                            <div class="brand-card-country">المنشأ / الاعتماد: <?= e($brandCountry) ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <h3>لا توجد علامات تجارية مضافة حالياً</h3>
                    <p>يرجى العودة لاحقاً للاطلاع على شركائنا من العلامات التجارية العالمية.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="brands-cta">
    <div class="container">
        <h2>هل تبحث عن علامة تجارية محددة لناديك؟</h2>
        <p>فريقنا يساعدك في توفير الأجهزة والمعدات المناسبة لمشروعك الرياضي بأفضل المواصفات.</p>
        <a href="<?= e(siteUrl('quote.php')) ?>" class="btn btn-primary">اطلب عرض سعر</a>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
