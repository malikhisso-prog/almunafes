<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'طلب عرض سعر';
$pageDescription = 'أرسل تفاصيل مشروعك واحصل على عرض سعر مناسب لتجهيز ناديك الرياضي.';
$currentPage = 'quote';

$categories = loadJson('categories.json', []);

$selectedProduct = trim((string)($_GET['product'] ?? ''));

require_once ROOT_PATH . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <span class="section-label">ابدأ مشروعك معنا</span>
        <h1>اطلب عرض سعر</h1>
        <p>أخبرنا عن مشروعك واحتياجاتك، وسنتواصل معك لمناقشة أفضل حلول التجهيز المناسبة.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">

        <div class="form-section">

            <div class="section-heading">
                <h2>تفاصيل مشروعك</h2>
                <p>املأ المعلومات التالية لمساعدتنا على إعداد عرض مناسب لاحتياجاتك.</p>
            </div>

            <?php if (is_file(ROOT_PATH . '/includes/flash-messages.php')) {
                require ROOT_PATH . '/includes/flash-messages.php';
            } ?>

            <form
                action="<?= e(siteUrl('send-quote.php')) ?>"
                method="POST"
                class="quote-form"
                data-validate
            >

                <div class="form-grid">

                    <div class="form-group">
                        <label for="name">الاسم الكامل *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            minlength="2"
                            placeholder="أدخل اسمك الكامل"
                        >
                    </div>

                    <div class="form-group">
                        <label for="phone">رقم الهاتف *</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            required
                            placeholder="أدخل رقم هاتفك"
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="example@email.com"
                        >
                    </div>

                    <div class="form-group">
                        <label for="project_type">نوع المشروع *</label>
                        <select id="project_type" name="project_type" required>
                            <option value="">اختر نوع المشروع</option>
                            <option value="commercial-gym">نادي رياضي تجاري</option>
                            <option value="women-gym">نادي رياضي نسائي</option>
                            <option value="hotel-gym">نادي فندق أو منتجع</option>
                            <option value="home-gym">نادي منزلي</option>
                            <option value="other">مشروع آخر</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="area">مساحة المشروع</label>
                        <input
                            type="text"
                            id="area"
                            name="area"
                            placeholder="مثال: 300 متر مربع"
                        >
                    </div>

                    <div class="form-group">
                        <label for="budget">الميزانية التقريبية</label>
                        <select id="budget" name="budget">
                            <option value="">اختر الميزانية</option>
                            <option value="under-10000">أقل من 10,000 دولار</option>
                            <option value="10000-25000">10,000 - 25,000 دولار</option>
                            <option value="25000-50000">25,000 - 50,000 دولار</option>
                            <option value="50000-100000">50,000 - 100,000 دولار</option>
                            <option value="over-100000">أكثر من 100,000 دولار</option>
                            <option value="undetermined">لم يتم تحديد الميزانية</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label>الأقسام المطلوبة</label>

                        <div class="category-checkboxes">
                            <?php foreach ($categories as $category): ?>
                                <?php if (!empty($category['active'])): ?>
                                    <label>
                                        <input
                                            type="checkbox"
                                            name="categories[]"
                                            value="<?= e($category['slug'] ?? '') ?>"
                                        >
                                        <span><?= e($category['name'] ?? '') ?></span>
                                    </label>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="details">تفاصيل إضافية</label>
                        <textarea
                            id="details"
                            name="details"
                            rows="6"
                            maxlength="5000"
                            placeholder="اكتب أي تفاصيل إضافية عن مشروعك أو الأجهزة التي تحتاجها..."
                        ><?= $selectedProduct !== '' ? e('أرغب في طلب عرض سعر للمنتج: ' . $selectedProduct) : '' ?></textarea>
                    </div>

                </div>

                <button type="submit" class="form-submit">
                    إرسال طلب عرض السعر
                </button>

            </form>

        </div>

    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
