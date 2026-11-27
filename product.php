<?php
require_once __DIR__ . '/config.php';

$slug = trim((string)($_GET['slug'] ?? ''));

$products = loadJson('products.json', []);
$categories = loadJson('categories.json', []);

$product = null;

foreach ($products as $item) {
    if (
        ($item['slug'] ?? '') === $slug &&
        !empty($item['active'])
    ) {
        $product = $item;
        break;
    }
}

if (!$product) {
    http_response_code(404);
    $pageTitle = 'المنتج غير موجود';
    require_once ROOT_PATH . '/includes/header.php';
    ?>
    <section class="section-padding">
        <div class="container empty-state">
            <h1>المنتج غير موجود</h1>
            <p>المنتج المطلوب غير متوفر أو تم نقله.</p>
            <a class="btn btn-primary" href="<?= e(siteUrl('products.php')) ?>">
                العودة إلى المنتجات
            </a>
        </div>
    </section>
    <?php
    require_once ROOT_PATH . '/includes/footer.php';
    exit;
}

$categoryName = '';
foreach ($categories as $cat) {
    if (($cat['slug'] ?? '') === ($product['category'] ?? '')) {
        $categoryName = $cat['name'] ?? '';
        break;
    }
}

$pageTitle = $product['name'] ?? 'تفاصيل المنتج';
$pageDescription = $product['short_description'] ?? $product['description'] ?? '';
$currentPage = 'products';

$mainImage = $product['image'] ?? 'assets/images/products/treadmill.jpg';

$gallery = $product['gallery'] ?? [];
if (!is_array($gallery)) {
    $gallery = [];
}

$gallery = array_values(array_unique(array_filter(
    array_merge([$mainImage], $gallery),
    static fn($image) => is_string($image) && trim($image) !== ''
)));

require_once ROOT_PATH . '/includes/header.php';
?>

<style>
.product-single-box {
    background: #ffffff;
    border: 1px solid #e8ece5;
    border-radius: 18px;
    padding: 36px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, .04);
}

.product-meta-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 16px;
}

.product-category-badge {
    display: inline-block;
    padding: 6px 14px;
    background: #f4f6f2;
    color: #3a423b;
    font-size: 12px;
    font-weight: 800;
    border-radius: 6px;
}

.product-lead {
    font-size: 17px;
    font-weight: 700;
    color: #111612;
    line-height: 1.9;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f2ee;
}

.product-desc-text {
    color: #555e54;
    font-size: 15.5px;
    line-height: 2.1;
    margin-bottom: 24px;
}

.product-highlights {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    background: #fafaf8;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #eceee9;
    margin-bottom: 28px;
}

.product-highlight-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 700;
    color: #1f241f;
}

.product-highlight-item span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #FFF6DF;
    color: #D18F00;
    font-weight: 900;
    font-size: 12px;
    flex-shrink: 0;
}

@media (max-width: 600px) {
    .product-single-box {
        padding: 22px;
    }
    .product-highlights {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="page-banner">
    <div class="container">
        <span class="section-label">منتجات المنافس</span>
        <h1><?= e($product['name'] ?? '') ?></h1>
        <p>تفاصيل ومواصفات المعدات الرياضية الاحترافية المخصصة للأندية ومراكز اللياقة.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">

        <div class="product-details-layout">

            <div class="product-gallery-wrapper">
                <img
                    src="<?= e(siteUrl($mainImage)) ?>"
                    alt="<?= e($product['name'] ?? '') ?>"
                    class="product-main-image"
                >

                <?php if (count($gallery) > 1): ?>
                    <div class="product-gallery">
                        <?php foreach ($gallery as $index => $image): ?>
                            <img
                                src="<?= e(siteUrl($image)) ?>"
                                alt="<?= e(($product['name'] ?? 'المنتج') . ' - صورة ' . ($index + 1)) ?>"
                                class="product-gallery-thumb <?= $index === 0 ? 'active' : '' ?>"
                                data-image="<?= e(siteUrl($image)) ?>"
                                loading="lazy"
                            >
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="product-info product-single-box">

                <div class="product-meta-badges">
                    <?php if (!empty($product['brand'])): ?>
                        <span class="product-brand"><?= e($product['brand']) ?></span>
                    <?php endif; ?>

                    <?php if ($categoryName !== ''): ?>
                        <span class="product-category-badge"><?= e($categoryName) ?></span>
                    <?php endif; ?>
                </div>

                <h1><?= e($product['name'] ?? '') ?></h1>

                <?php if (!empty($product['short_description'])): ?>
                    <div class="product-lead">
                        <?= e($product['short_description']) ?>
                    </div>
                <?php endif; ?>

                <div class="product-desc-text">
                    <?= nl2br(e($product['description'] ?? '')) ?>
                </div>

                <div class="product-highlights">
                    <div class="product-highlight-item"><span>✓</span> جودة تجارية للاستخدام المكثف</div>
                    <div class="product-highlight-item"><span>✓</span> مناسب للأندية ومراكز اللياقة</div>
                    <div class="product-highlight-item"><span>✓</span> ضمان وتوفير قطع الغيار</div>
                    <div class="product-highlight-item"><span>✓</span> خدمة التوريد والتركيب</div>
                </div>

                <div class="product-actions">
                    <a
                        href="<?= e(siteUrl('quote.php?product=' . urlencode($product['name'] ?? ''))) ?>"
                        class="btn btn-primary"
                    >
                        اطلب عرض سعر لهذا الجهاز
                    </a>

                    <a
                        href="<?= e(siteUrl('products.php')) ?>"
                        class="btn btn-outline"
                    >
                        العودة للمنتجات
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
