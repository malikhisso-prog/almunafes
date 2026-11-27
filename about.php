<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'من نحن | المنافس لتجهيز الأندية الرياضية';
$pageDescription = 'تعرف على المنافس المتخصصة في توفير المعدات الرياضية وحلول تجهيز الأندية الرياضية ومراكز اللياقة البدنية.';
$currentPage = 'about';

$values = [
    ['number' => '01', 'icon' => '★', 'title' => 'الاهتمام بالجودة', 'description' => 'نختار أجهزة ومعدات رياضية بعناية لتناسب الاستخدام التجاري في الأندية ومراكز اللياقة.'],
    ['number' => '02', 'icon' => '⚙', 'title' => 'تنوع الحلول', 'description' => 'نوفر خيارات متعددة تشمل الكارديو والقوة والأوزان الحرة والتدريب الوظيفي.'],
    ['number' => '03', 'icon' => '🤝', 'title' => 'التركيز على احتياجات العميل', 'description' => 'نساعد عملاءنا في اختيار التجهيزات المناسبة لطبيعة المشروع ومساحة المكان.']
];

require_once ROOT_PATH . '/includes/header.php';
?>
<section class="page-banner">
    <div class="container">
        <span class="section-eyebrow">ABOUT US</span>
        <h1>من نحن</h1>
        <p>المنافس متخصصة في توفير الأجهزة والمعدات الرياضية وحلول تجهيز الأندية ومراكز اللياقة البدنية.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container about-intro-grid">
        <div class="about-intro-image">
            <img src="<?= e(imageUrl('hero/hero-main.jpg')) ?>" alt="تجهيز الأندية الرياضية - المنافس">
        </div>
        <div class="about-intro-content">
            <span class="section-eyebrow">WHO WE ARE</span>
            <h2>أكثر من مجرد أجهزة، <span>نحن شريك لتجهيز مشروعك الرياضي</span></h2>
            <p>في المنافس، نعمل على توفير أجهزة رياضية تجارية تلبي احتياجات الأندية الرياضية ومراكز اللياقة بمختلف أحجامها، مع التركيز على العملية وجودة الاستخدام وتنوع الخيارات.</p>
            <p>نسعى لأن نكون خياراً موثوقاً لكل من يبحث عن تجهيز نادٍ رياضي متكامل أو تطوير مساحة تدريبية بمعدات مناسبة للاستخدام المستمر.</p>
            <a href="<?= e(siteUrl('products.php')) ?>" class="btn btn-primary">استكشف منتجاتنا</a>
        </div>
    </div>
</section>

<section class="about-values section-padding">
    <div class="container">
        <div class="section-heading">
            <span class="section-eyebrow">OUR VALUES</span>
            <h2>ما الذي يميز عملنا</h2>
            <p>نعمل برؤية واضحة لتقديم تجربة تجهيز احترافية وعملية.</p>
        </div>
        <div class="about-values-grid">
            <?php foreach ($values as $value): ?>
                <article class="about-value-card">
                    <span class="value-number"><?= e($value['number']) ?></span>
                    <div class="value-icon"><?= e($value['icon']) ?></div>
                    <h3><?= e($value['title']) ?></h3>
                    <p><?= e($value['description']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container about-services-grid">
        <div class="about-services-content">
            <span class="section-eyebrow">OUR SERVICES</span>
            <h2>نساعدك في اختيار <span>المعدات المناسبة لمشروعك</span></h2>
            <p>سواء كنت تؤسس نادياً رياضياً جديداً أو تطور مساحة تدريب قائمة، نساعدك في اختيار الأجهزة المناسبة وتقديم عرض سعر مخصص لاحتياجاتك.</p>
            <ul class="about-services-list">
                <li><span>✓</span> تجهيز الأندية الرياضية المتكاملة</li>
                <li><span>✓</span> توفير أجهزة الكارديو والقوة والأوزان الحرة</li>
                <li><span>✓</span> تقديم عروض أسعار مخصصة للمشاريع</li>
            </ul>
            <a href="<?= e(siteUrl('quote.php')) ?>" class="btn btn-primary">اطلب عرض سعر</a>
        </div>
        <div class="about-services-image">
            <img src="<?= e(imageUrl('products/chest-press.jpg')) ?>" alt="خدمات تجهيز الأندية">
        </div>
    </div>
</section>

<section class="final-cta">
    <div class="container">
        <h2>هل تخطط لتجهيز نادٍ رياضي؟</h2>
        <p>تواصل معنا لمساعدتك في اختيار الأجهزة المناسبة لمشروعك.</p>
        <a href="<?= e(siteUrl('contact.php')) ?>" class="btn btn-primary">تواصل معنا</a>
    </div>
</section>
<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
