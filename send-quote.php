
<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function quoteLength(string $value): int
{
    return function_exists('mb_strlen')
        ? mb_strlen($value, 'UTF-8')
        : strlen($value);
}

function redirectToQuote(): never
{
    header('Location: quote.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectToQuote();
}

$name = trim((string)($_POST['name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$projectType = trim((string)($_POST['project_type'] ?? ''));
$area = trim((string)($_POST['area'] ?? ''));
$budget = trim((string)($_POST['budget'] ?? ''));
$details = trim((string)($_POST['details'] ?? ''));

$categories = $_POST['categories'] ?? [];

if (!is_array($categories)) {
    $categories = [];
}

$categories = array_values(array_filter(
    array_map(
        static fn($value) => trim((string)$value),
        $categories
    ),
    static fn($value) => $value !== ''
));

$errors = [];

if ($name === '' || quoteLength($name) < 2) {
    $errors[] = 'يرجى إدخال الاسم بشكل صحيح.';
}

if ($phone === '') {
    $errors[] = 'يرجى إدخال رقم الهاتف.';
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'البريد الإلكتروني غير صحيح.';
}

if ($projectType === '') {
    $errors[] = 'يرجى تحديد نوع المشروع.';
}

if ($details !== '' && quoteLength($details) > 5000) {
    $errors[] = 'تفاصيل الطلب طويلة جداً.';
}

if ($errors) {
    $_SESSION['form_errors'] = $errors;
    redirectToQuote();
}

$dataFile = __DIR__ . '/data/quotes.json';

if (!is_file($dataFile) || !is_writable($dataFile)) {
    $_SESSION['form_errors'] = [
        'تعذر حفظ طلب عرض السعر حالياً. يرجى المحاولة لاحقاً.'
    ];
    redirectToQuote();
}

$quotes = json_decode(
    (string)file_get_contents($dataFile),
    true
);

if (!is_array($quotes)) {
    $quotes = [];
}

$quotes[] = [
    'id' => uniqid('quote_', true),
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'project_type' => $projectType,
    'area' => $area,
    'budget' => $budget,
    'categories' => $categories,
    'details' => $details,
    'created_at' => date('Y-m-d H:i:s'),
    'status' => 'new'
];

$json = json_encode(
    $quotes,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
);

if ($json === false || file_put_contents($dataFile, $json, LOCK_EX) === false) {
    $_SESSION['form_errors'] = [
        'حدث خطأ أثناء حفظ الطلب. يرجى المحاولة مرة أخرى.'
    ];
    redirectToQuote();
}

$_SESSION['form_success'] = 'تم إرسال طلب عرض السعر بنجاح. سنتواصل معك قريباً.';

redirectToQuote();
