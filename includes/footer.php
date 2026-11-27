
<footer class="site-footer">

    <div class="footer-main">

        <div class="footer-container">

            <div class="footer-brand">

                <a href="<?= e(siteUrl('index.php')) ?>" class="site-logo footer-logo">
                    <span class="logo-mark">M</span>

                    <span class="logo-text">
                        <strong>المنافس</strong>
                        <small>FITNESS EQUIPMENT</small>
                    </span>
                </a>

                <p>
                    نوفر حلولاً متكاملة لتجهيز النوادي الرياضية بأجهزة
                    احترافية تجمع بين الجودة والأداء والتصميم العصري.
                </p>

            </div>

            <div class="footer-column">

                <h3>روابط سريعة</h3>

                <ul>
                    <li><a href="<?= e(siteUrl('index.php')) ?>">الرئيسية</a></li>
                    <li><a href="<?= e(siteUrl('products.php')) ?>">الأجهزة الرياضية</a></li>
                    <li><a href="<?= e(siteUrl('brands.php')) ?>">العلامات التجارية</a></li>
                    <li><a href="<?= e(siteUrl('solutions.php')) ?>">حلول النوادي</a></li>
                </ul>

            </div>

            <div class="footer-column">

                <h3>عن الشركة</h3>

                <ul>
                    <li><a href="<?= e(siteUrl('about.php')) ?>">من نحن</a></li>
                    <li><a href="<?= e(siteUrl('contact.php')) ?>">تواصل معنا</a></li>
                    <li><a href="<?= e(siteUrl('quote.php')) ?>">طلب عرض سعر</a></li>
                </ul>

            </div>

            <div class="footer-column footer-contact">

                <h3>تواصل معنا</h3>

                <p>يسعدنا مساعدتك في اختيار الأجهزة المناسبة لناديك الرياضي.</p>

                <a href="<?= e(siteUrl('contact.php')) ?>" class="footer-contact-link">
                    أرسل لنا استفسارك
                    <span>←</span>
                </a>

            </div>

        </div>

    </div>

    <div class="footer-bottom">

        <div class="footer-bottom-container">

            <p>
                © <?= date('Y') ?> المنافس.
                جميع الحقوق محفوظة.
            </p>

            <span>FITNESS EQUIPMENT & SOLUTIONS</span>

        </div>

    </div>

</footer>

<script src="<?= e(JS_URL) ?>/main.js"></script>

</body>
</html>
