<?php
session_start();
require_once dirname(__DIR__) . '/config.php';

// كلمة المرور الخاصة بلوحة التحكم (يمكنك تغييرها هنا)
define('ADMIN_PASS', 'almunafes2026');

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$loginError = '';
if (isset($_POST['login_pass'])) {
    if ($_POST['login_pass'] === ADMIN_PASS) {
        $_SESSION['is_admin'] = true;
        header('Location: index.php');
        exit;
    } else {
        $loginError = 'كلمة المرور غير صحيحة!';
    }
}

$productsFile = ROOT_PATH . '/data/products.json';
$products = loadJson('products.json', []);
$message = '';
$error = '';

// حذف منتج
if (!empty($_SESSION['is_admin']) && isset($_GET['delete'])) {
    $delId = $_GET['delete'];
    $products = array_values(array_filter($products, static fn($p) => ($p['id'] ?? '') !== $delId));
    file_put_contents($productsFile, json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    $message = 'تم حذف الجهاز بنجاح.';
}

// إضافة منتج جديد
if (!empty($_SESSION['is_admin']) && isset($_POST['add_product'])) {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? 'أجهزة القوة');
    $brand = trim($_POST['brand'] ?? 'ALMUNAFES PRO');
    $price = trim($_POST['price'] ?? '');
    $shortDesc = trim($_POST['short_desc'] ?? '');
    $fullDesc = trim($_POST['full_desc'] ?? '');
    $imageName = 'chest-press.jpg';

    if ($name === '') {
        $error = 'يرجى إدخال اسم الجهاز.';
    } else {
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            if (in_array($ext, $allowed, true)) {
                $uploadDir = ROOT_PATH . '/assets/images/products/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $newFileName = 'prod_' . time() . '_' . rand(100, 999) . '.' . $ext;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $newFileName)) {
                    $imageName = $newFileName;
                }
            }
        }

        $newProduct = [
            'id' => 'prod_' . time(),
            'slug' => 'item-' . time(),
            'name' => $name,
            'category' => $category,
            'brand' => $brand,
            'price' => $price !== '' ? $price : 'تواصل للسعر',
            'short_description' => $shortDesc !== '' ? $shortDesc : $name,
            'description' => $fullDesc !== '' ? $fullDesc : $shortDesc,
            'image' => $imageName,
            'featured' => true,
            'active' => true
        ];

        array_unshift($products, $newProduct);
        file_put_contents($productsFile, json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $message = 'تم إضافة الجهاز وصورته بنجاح! سيظهر الآن في الموقع والتطبيق.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة إدارة المنتجات | المنافس</title>
    <link href="https://googleapis.com" rel="stylesheet">
    <style>
        * { box-sizing: border-box; font-family: 'Cairo', sans-serif; }
        body { margin: 0; background: #141311; color: #fff; }
        .topbar { background: #1F1E1B; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(242,169,0,.25); }
        .logo { font-weight: 900; font-size: 20px; color: #F2A900; }
        .logout { color: #fff; text-decoration: none; background: #2D2B27; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; }
        .container { max-width: 1050px; margin: 30px auto; padding: 0 16px; }
        .login-box { max-width: 400px; margin: 90px auto; background: #1F1E1B; padding: 32px; border-radius: 18px; border: 1px solid rgba(242,169,0,.3); text-align: center; }
        .card { background: #1F1E1B; padding: 24px; border-radius: 18px; border: 1px solid rgba(255,255,255,.08); margin-bottom: 28px; }
        h2 { margin-top: 0; color: #F2A900; font-weight: 900; font-size: 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
        label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: 700; color: #ccc; }
        input, select, textarea { width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #3A3833; background: #141311; color: #fff; font-size: 14px; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #F2A900; }
        .btn { background: #F2A900; color: #141311; border: 0; padding: 13px 24px; border-radius: 10px; font-weight: 900; font-size: 15px; cursor: pointer; width: 100%; margin-top: 14px; }
        .btn:hover { background: #FFBA1A; }
        .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 18px; font-weight: 700; font-size: 14px; }
        .alert-success { background: rgba(34,197,94,.15); color: #4ADE80; border: 1px solid #22C55E; }
        .alert-error { background: rgba(239,68,68,.15); color: #F87171; border: 1px solid #EF4444; }
        .prod-item { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 14px; background: #141311; border-radius: 12px; margin-bottom: 12px; border: 1px solid #2A2824; }
        .prod-info { display: flex; align-items: center; gap: 14px; }
        .prod-info img { width: 62px; height: 62px; object-fit: cover; border-radius: 10px; background: #222; }
        .del-btn { background: rgba(239,68,68,.15); color: #F87171; text-decoration: none; padding: 8px 14px; border-radius: 8px; font-weight: 800; font-size: 13px; white-space: nowrap; }
    </style>
</head>
<body>

<?php if (empty($_SESSION['is_admin'])): ?>
    <div class="login-box">
        <div class="logo" style="font-size:26px; margin-bottom:8px;">المنافس</div>
        <p style="color:#aaa; font-size:14px; margin-bottom:20px;">تسجيل الدخول إلى لوحة إدارة المنتجات</p>
        <?php if ($loginError): ?><div class="alert alert-error"><?= e($loginError) ?></div><?php endif; ?>
        <form method="post">
            <input type="password" name="login_pass" placeholder="أدخل كلمة المرور..." required>
            <button type="submit" class="btn">دخول للوحة التحكم</button>
        </form>
    </div>
<?php else: ?>
    <div class="topbar">
        <div class="logo">لوحة إدارة منتجات المنافس</div>
        <div>
            <a href="../products.php" target="_blank" class="logout" style="margin-left:8px;">معاينة الموقع</a>
            <a href="?logout=1" class="logout">تسجيل خروج</a>
        </div>
    </div>

    <div class="container">
        <?php if ($message): ?><div class="alert alert-success"><?= e($message) ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>

        <div class="card">
            <h2>+ إضافة جهاز رياضي جديد</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="grid">
                    <div>
                        <label>اسم الجهاز *</label>
                        <input type="text" name="name" placeholder="مثال: جهاز المشي التجاري T900" required>
                    </div>
                    <div>
                        <label>القسم</label>
                        <select name="category">
                            <option value="أجهزة الكارديو">أجهزة الكارديو</option>
                            <option value="أجهزة القوة">أجهزة القوة</option>
                            <option value="الأوزان الحرة">الأوزان الحرة</option>
                            <option value="التدريب الوظيفي">التدريب الوظيفي</option>
                        </select>
                    </div>
                    <div>
                        <label>العلامة التجارية</label>
                        <input type="text" name="brand" value="ALMUNAFES PRO">
                    </div>
                    <div>
                        <label>السعر (اتركه فارغاً ليظهر: تواصل للسعر)</label>
                        <input type="text" name="price" placeholder="مثال: 1200$ أو تواصل للسعر">
                    </div>
                </div>

                <div style="margin-top:16px;">
                    <label>وصف مختصر للجهاز (يظهر في البطاقة)</label>
                    <input type="text" name="short_desc" placeholder="مثال: محرك AC قوي مصمم للعمل الشاق في الأندية التجارية">
                </div>

                <div style="margin-top:16px;">
                    <label>الوصف الكامل والمواصفات الفنية</label>
                    <textarea name="full_desc" rows="3" placeholder="اكتب تفاصيل الجهاز ومواصفاته الفنية هنا..."></textarea>
                </div>

                <div style="margin-top:16px;">
                    <label>صورة الجهاز (JPG, PNG, WEBP)</label>
                    <input type="file" name="image" accept="image/*">
                </div>

                <button type="submit" name="add_product" class="btn">حفظ ونشر الجهاز في الموقع والتطبيق</button>
            </form>
        </div>

        <div class="card">
            <h2>الأجهزة الحالية (<?= count($products) ?>)</h2>
            <?php foreach ($products as $p): ?>
                <div class="prod-item">
                    <div class="prod-info">
                        <img src="<?= e(imageUrl('products/' . ($p['image'] ?? 'chest-press.jpg'))) ?>" alt="">
                        <div>
                            <div style="font-weight:900; font-size:15px;"><?= e($p['name'] ?? '') ?></div>
                            <div style="font-size:12.5px; color:#aaa; margin-top:4px;">
                                <?= e($p['category'] ?? '') ?> • <span style="color:#F2A900;"><?= e($p['price'] ?? 'تواصل للسعر') ?></span>
                            </div>
                        </div>
                    </div>
                    <a href="?delete=<?= e($p['id'] ?? '') ?>" class="del-btn" onclick="return confirm('هل أنت متأكد من حذف هذا الجهاز؟')">حذف</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
