
<?php
$productImage = $product['image'] ?? 'assets/images/general/product-placeholder.jpg';
$productName = $product['name'] ?? 'منتج رياضي';
$productSlug = $product['slug'] ?? '';
$productBrand = $product['brand'] ?? '';
$productDescription = $product['short_description'] ?? $product['description'] ?? '';
?>

<article class="product-card">

    <a
        href="<?= e(siteUrl('product.php?slug=' . urlencode($productSlug))) ?>"
        class="product-card-image"
        aria-label="<?= e($productName) ?>"
    >
        <img
            src="<?= e(siteUrl($productImage)) ?>"
            alt="<?= e($productName) ?>"
            loading="lazy"
        >
    </a>

    <div class="product-card-content">

        <?php if ($productBrand !== ''): ?>
            <span class="product-card-brand">
                <?= e($productBrand) ?>
            </span>
        <?php endif; ?>

        <h3>
            <a href="<?= e(siteUrl('product.php?slug=' . urlencode($productSlug))) ?>">
                <?= e($productName) ?>
            </a>
        </h3>

        <p><?= e($productDescription) ?></p>

        <a
            class="product-card-link"
            href="<?= e(siteUrl('product.php?slug=' . urlencode($productSlug))) ?>"
        >
            عرض تفاصيل المنتج
            <span aria-hidden="true">←</span>
        </a>

    </div>

</article>
