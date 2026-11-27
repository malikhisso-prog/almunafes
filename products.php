
<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'المنتجات';
$pageDescription = 'اكتشف مجموعة أجهزة وتجهيزات الأندية الرياضية الاحترافية.';
$currentPage = 'products';

$products = loadJson('products.json', []);
$categories = loadJson('categories.json', []);

$selectedCategory = trim((string)($_GET['category'] ?? ''));
$searchQuery = trim((string)($_GET['q'] ?? ''));

$filteredProducts = array_filter($products, function ($product) use ($selectedCategory, $searchQuery) {
    if (empty($product['active'])) {
        return false;
    }

    if ($selectedCategory !== '' &&
        ($product['category'] ?? '') !== $selectedCategory) {
        return false;
    }

    if ($searchQuery !== '') {
        $searchableText = implode(' ', [
            $product['name'] ?? '',
            $product['description'] ?? '',
            $product['brand'] ?? '',
        ]);

        if (function_exists('mb_stripos')) {
            if (mb_stripos($searchableText, $searchQuery) === false) {
                return false;
            }
        } elseif (stripos($searchableText, $searchQuery) === false) {
            return false;
        }
    }

    return true;
});

require_once ROOT_PATH . '/includes/header.php';
?>

<style>
/* Product categories - isolated layout */
.products-layout {
    display: grid !important;
    grid-template-columns: 250px minmax(0, 1fr) !important;
    align-items: start !important;
    gap: 35px !important;
    width: 100% !important;
}

.products-sidebar {
    display: block !important;
    width: 100% !important;
    min-width: 0 !important;
    padding: 24px !important;
    background: #fff !important;
    border: 1px solid #e8ece5 !important;
    border-radius: 12px !important;
}

.products-sidebar h3 {
    display: block !important;
    margin: 0 0 20px !important;
    font-size: 18px !important;
    font-weight: 800 !important;
    color: #111612 !important;
}

.category-filter {
    display: flex !important;
    flex-direction: column !important;
    align-items: stretch !important;
    justify-content: flex-start !important;
    gap: 8px !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}

.category-filter a {
    display: block !important;
    position: static !important;
    float: none !important;
    width: 100% !important;
    min-width: 0 !important;
    margin: 0 !important;
    padding: 12px 14px !important;
    border: 1px solid transparent !important;
    border-radius: 7px !important;
    background: #f7f7f7 !important;
    color: #394238 !important;
    font-family: 'Cairo', sans-serif !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    line-height: 1.8 !important;
    text-align: right !important;
    text-decoration: none !important;
    white-space: normal !important;
    box-sizing: border-box !important;
}

.category-filter a:hover,
.category-filter a.active {
    background: #fff3d6 !important;
    border-color: #F2A900 !important;
    color: #111612 !important;
}

@media (max-width: 850px) {
    .products-layout {
        grid-template-columns: 1fr !important;
    }
}
</style>

<section class="page-banner">
    <div class="container">
        <span class="section-label">مجموعة المنافس</span>
        <h1>منتجاتنا الرياضية</h1>
        <p>اكتشف معدات رياضية احترافية مصممة لتلبية احتياجات الأندية والمنشآت الرياضية.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">

        <form method="GET" action="<?= e(siteUrl('products.php')) ?>" class="product-search">
            <input
                type="search"
                name="q"
                value="<?= e($searchQuery) ?>"
                placeholder="ابحث عن جهاز أو منتج..."
            >

            <?php if ($selectedCategory !== ''): ?>
                <input type="hidden" name="category" value="<?= e($selectedCategory) ?>">
            <?php endif; ?>

            <button type="submit">بحث</button>
        </form>

        <div class="products-layout">

            <aside class="products-sidebar">
                <h3>تصنيفات المنتجات</h3>

                <nav class="category-filter">
                    <a
                        href="<?= e(siteUrl('products.php')) ?>"
                        class="<?= $selectedCategory === '' ? 'active' : '' ?>"
                    >
                        جميع المنتجات
                    </a>

                    <?php foreach ($categories as $category): ?>
                        <?php if (!empty($category['active'])): ?>
                            <a
                                href="<?= e(siteUrl('products.php?category=' . urlencode($category['slug']))) ?>"
                                class="<?= $selectedCategory === ($category['slug'] ?? '') ? 'active' : '' ?>"
                            >
                                <?= e($category['name'] ?? '') ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </nav>
            </aside>

            <div class="products-results">
                <div class="products-grid">

                    <?php if (!empty($filteredProducts)): ?>

                        <?php foreach ($filteredProducts as $product): ?>
                            <?php require ROOT_PATH . '/includes/product-card.php'; ?>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="empty-state">
                            <h3>لا توجد منتجات</h3>
                            <p>لم نعثر على منتجات تطابق خيارات البحث الحالية.</p>
                        </div>

                    <?php endif; ?>

                </div>
            </div>

        </div>

    </div>
</section>

<?php require ROOT_PATH . '/includes/footer.php'; ?>