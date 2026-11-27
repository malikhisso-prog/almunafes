
<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function messageLength(string $value): int
{
    return function_exists('mb_strlen')
        ? mb_strlen($value, 'UTF-8')
        : strlen($value);
}

function redirectToContact(): never
{
    header('Location: contact.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectToContact();
}

$name = trim((string)($_POST['name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$subject = trim((string)($_POST['subject'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

$errors = [];

if ($name === '' || messageLength($name) < 2) {
    $errors[] = 'يرجى إدخال اسم صحيح.';
}

if ($phone === '') {
    $errors[] = 'يرجى إدخال رقم الهاتف.';
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'البريد الإلكتروني غير صحيح.';
}

if ($subject === '') {
    $errors[] = 'يرجى إدخال موضوع الرسالة.';
}

if ($message === '' || messageLength($message) < 10) {
    $errors[] = 'يجب أن تحتوي الرسالة على 10 أحرف على الأقل.';
}

if ($errors) {
    $_SESSION['form_errors'] = $errors;
    redirectToContact();
}

$dataFile = __DIR__ . '/data/messages.json';

if (!is_file($dataFile) || !is_writable($dataFile)) {
    $_SESSION['form_errors'] = [
        'تعذر حفظ الرسالة حالياً. يرجى المحاولة لاحقاً.'
    ];
    redirectToContact();
}

$messages = json_decode(
    (string)file_get_contents($dataFile),
    true
);

if (!is_array($messages)) {
    $messages = [];
}

$messages[] = [
    'id' => uniqid('msg_', true),
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'subject' => $subject,
    'message' => $message,
    'created_at' => date('Y-m-d H:i:s'),
    'status' => 'new'
];

$json = json_encode(
    $messages,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
);

if ($json === false || file_put_contents($dataFile, $json, LOCK_EX) === false) {
    $_SESSION['form_errors'] = [
        'حدث خطأ أثناء حفظ الرسالة. يرجى المحاولة مرة أخرى.'
    ];
    redirectToContact();
}

$_SESSION['form_success'] = 'تم استلام رسالتك بنجاح. سنتواصل معك قريباً.';

redirectToContact();
