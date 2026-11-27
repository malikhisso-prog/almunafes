<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'تواصل معنا';
$pageDescription = 'تواصل مع شركة المنافس للاستفسار عن أجهزة وتجهيزات الأندية الرياضية.';
$currentPage = 'contact';

require_once ROOT_PATH . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <span class="section-label">نحن هنا لمساعدتك</span>
        <h1>تواصل معنا</h1>
        <p>يسعدنا الإجابة عن استفساراتك ومساعدتك في اختيار التجهيزات الرياضية المناسبة لمشروعك.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">

        <div class="contact-layout">

            <div class="contact-info">

                <span class="section-label">ابقَ على تواصل</span>
                <h2>دعنا نتحدث عن مشروعك</h2>

                <p>
                    سواء كنت تخطط لإنشاء نادٍ رياضي جديد أو تطوير منشأتك الحالية،
                    فريق المنافس جاهز لمساعدتك في الوصول إلى التجهيز المناسب.
                </p>

                <div class="contact-info-item">
                    <span class="contact-info-icon">☎</span>
                    <div>
                        <h3>الهاتف</h3>
                        <a href="tel:+963000000000">+963 000 000 000</a>
                    </div>
                </div>

                <div class="contact-info-item">
                    <span class="contact-info-icon">✉</span>
                    <div>
                        <h3>البريد الإلكتروني</h3>
                        <a href="mailto:info@almunafes.com">info@almunafes.com</a>
                    </div>
                </div>

                <div class="contact-info-item">
                    <span class="contact-info-icon">⌖</span>
                    <div>
                        <h3>العنوان</h3>
                        <p>يرجى إضافة عنوان الشركة هنا</p>
                    </div>
                </div>

            </div>

            <div class="contact-form-wrapper">

                <h2>أرسل لنا رسالة</h2>
                <p>املأ النموذج وسنعود إليك في أقرب وقت ممكن.</p>

                <?php if (is_file(ROOT_PATH . '/includes/flash-messages.php')) {
                    require ROOT_PATH . '/includes/flash-messages.php';
                } ?>

                <form
                    action="<?= e(siteUrl('send-contact.php')) ?>"
                    method="POST"
                    class="contact-form"
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

                        <div class="form-group full-width">
                            <label for="email">البريد الإلكتروني</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="example@email.com"
                            >
                        </div>

                        <div class="form-group full-width">
                            <label for="subject">موضوع الرسالة *</label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                required
                                placeholder="موضوع رسالتك"
                            >
                        </div>

                        <div class="form-group full-width">
                            <label for="message">الرسالة *</label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                required
                                minlength="10"
                                placeholder="اكتب رسالتك هنا..."
                            ></textarea>
                        </div>

                    </div>

                    <button type="submit" class="form-submit">
                        إرسال الرسالة
                    </button>

                </form>

            </div>

        </div>

    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
