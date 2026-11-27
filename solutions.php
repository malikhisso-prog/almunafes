<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'حلول تجهيز النوادي الرياضية | المنافس';
$pageDescription = 'حلول متكاملة لتجهيز الأندية الرياضية ومراكز اللياقة البدنية بأحدث المعدات وتوزيع احترافي للمساحات.';
$currentPage = 'solutions';

$solutionTypes = [
    [
        'number' => '01',
        'title' => 'تجهيز الأندية التجارية الكبيرة',
        'description' => 'توفير تشكيلة شاملة من أجهزة الكارديو والقوة والأوزان الحرة المصممة لتحمل الاستخدام المكثف على مدار الساعة.',
        'image' => imageUrl('hero/hero-main.jpg')
    ],
    [
        'number' => '02',
        'title' => 'تجهيز الاستوديوهات ومراكز التدريب',
        'description' => 'حلول ذكية للمساحات المتوسطة والخاصة تشمل معدات التدريب الوظيفي والأجهزة متعددة الاستخدامات.',
        'image' => imageUrl('products/adjustable-bench.jpg')
    ],
    [
        'number' => '03',
        'title' => 'الأندية الفندقية والخاصة',
        'description' => 'تجهيزات أنيقة وعملية تناسب الفنادق والمجمعات السكنية والشركات بأعلى معايير الأمان والهدوء.',
        'image' => imageUrl('products/treadmill.jpg')
    ]
];

$equipmentFeatures = [
    [
        'tag' => 'CARDIO ZONE',
        'title' => 'منطقة الكارديو واللياقة القلبية',
        'image' => imageUrl('products/elliptical.jpg')
    ],
    [
        'tag' => 'STRENGTH ZONE',
        'title' => 'منطقة أجهزة القوة والمقاومة',
        'image' => imageUrl('products/chest-press.jpg')
    ],
    [
        'tag' => 'FREE WEIGHTS',
        'title' => 'منطقة الأوزان الحرة والدمبل',
        'image' => imageUrl('products/dumbbells.jpg')
    ]
];

require_once ROOT_PATH . '/includes/header.php';
?>

<section class="page-banner">
    <div class="container">
        <span class="section-eyebrow">GYM SOLUTIONS</span>
        <h1>حلول تجهيز النوادي الرياضية</h1>
        <p>نرافقك من مرحلة الفكرة والتخطيط وحتى التركيب والتشغيل لبناء نادٍ رياضي متكامل يلبي طموحاتك.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container solutions-intro-grid">
        <div class="solutions-intro-content">
            <span class="section-eyebrow">YOUR GYM, YOUR VISION</span>
            <h2>كل مشروع رياضي يحتاج إلى <span>تجهيز يناسب رؤيته.</span></h2>
            <p>
                تختلف احتياجات النوادي الرياضية بحسب المساحة ونوعية الأعضاء وطبيعة التدريبات.
                لذلك نركز على توفير خيارات متنوعة من الأجهزة التي تساعدك على بناء مشروع رياضي متكامل.
            </p>
            <a href="<?= e(siteUrl('contact.php')) ?>" class="btn btn-primary">ناقش مشروعك معنا ←</a>
        </div>

        <div class="solutions-intro-image">
            <img src="<?= e(imageUrl('hero/hero-main.jpg')) ?>" alt="تصميم وتجهيز نادٍ رياضي احترافي">
        </div>
    </div>
</section>

<section class="solution-types section-padding">
    <div class="container">
        <div class="section-heading">
            <span class="section-eyebrow">TAILORED SOLUTIONS</span>
            <h2>حلول مصممة لمختلف المشاريع</h2>
            <p>نقدم باقات وتجهيزات مرنة تتوافق مع مساحة مشروعك وميزانيتك.</p>
        </div>

        <div class="solution-cards-grid">
            <?php foreach ($solutionTypes as $sol): ?>
                <article class="solution-card">
                    <div class="solution-card-image">
                        <img src="<?= e($sol['image']) ?>" alt="<?= e($sol['title']) ?>" loading="lazy">
                        <span><?= e($sol['number']) ?></span>
                    </div>
                    <div class="solution-card-content">
                        <h3><?= e($sol['title']) ?></h3>
                        <p><?= e($sol['description']) ?></p>
                        <a href="<?= e(siteUrl('quote.php')) ?>" class="text-link">اطلب استشارة للمشروع ←</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-heading">
            <span class="section-eyebrow">TRAINING ZONES</span>
            <h2>توزيع مناطق التدريب في ناديك</h2>
            <p>نساعدك في تقسيم المساحات بشكل عملي يضمن انسيابية الحركة وراحة المتدربين.</p>
        </div>

        <div class="solutions-equipment-grid">
            <?php foreach ($equipmentFeatures as $feat): ?>
                <div class="equipment-feature">
                    <img src="<?= e($feat['image']) ?>" alt="<?= e($feat['title']) ?>" loading="lazy">
                    <div>
                        <span><?= e($feat['tag']) ?></span>
                        <h3><?= e($feat['title']) ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="final-cta">
    <div class="container">
        <h2>جاهز لبدء مشروعك الرياضي؟</h2>
        <p>تواصل معنا اليوم للحصول على استشارة مجانية وعرض سعر شامل لتجهيز ناديك.</p>
        <a href="<?= e(siteUrl('quote.php')) ?>" class="btn btn-primary">اطلب عرض سعر الآن</a>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
