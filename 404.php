<?php
http_response_code(404);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/header.php';
?>

<main class="error-page">
    <div class="container">
        <div class="error-content">
            <span class="error-code">404</span>

            <h1>الصفحة غير موجودة</h1>

            <p>
                عذراً، الصفحة التي تبحث عنها غير متاحة
                أو ربما تم نقلها إلى مكان آخر.
            </p>

            <div class="error-actions">
                <a href="<?= SITE_URL ?>/index.php" class="btn btn-primary">
                    العودة إلى الرئيسية
                </a>

                <a href="<?= SITE_URL ?>/contact.php" class="btn btn-outline">
                    تواصل معنا
                </a>
            </div>
        </div>
    </div>
</main>

<style>
.error-page {
    min-height: 65vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 20px;
    text-align: center;
}

.error-content {
    max-width: 650px;
    margin: auto;
}

.error-code {
    display: block;
    font-size: clamp(100px, 20vw, 180px);
    font-weight: 900;
    line-height: 1;
    color: #d71920;
}

.error-content h1 {
    margin: 25px 0 15px;
    font-size: 32px;
}

.error-content p {
    color: #777;
    line-height: 1.9;
    margin-bottom: 30px;
}

.error-actions {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>