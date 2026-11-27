<?php

/*
|--------------------------------------------------------------------------
| ALMUNAFES CONFIGURATION
|--------------------------------------------------------------------------
*/

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

define('SITE_NAME', 'المنافس');
define('SITE_URL', $protocol . $host . '/almunafes');

define('SITE_ROOT', __DIR__);
define('ROOT_PATH', SITE_ROOT);

define('DATA_PATH', SITE_ROOT . '/data/');
define('ASSETS_PATH', SITE_URL . '/assets');

define('CSS_URL', ASSETS_PATH . '/css');
define('JS_URL', ASSETS_PATH . '/js');
define('IMAGE_URL', ASSETS_PATH . '/images');
define('IMG_URL', IMAGE_URL);

/*
|--------------------------------------------------------------------------
| TIMEZONE
|--------------------------------------------------------------------------
*/

date_default_timezone_set('Asia/Damascus');

/*
|--------------------------------------------------------------------------
| ERROR SETTINGS
|--------------------------------------------------------------------------
*/

error_reporting(E_ALL);
ini_set('display_errors', '1');

/*
|--------------------------------------------------------------------------
| SESSION
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| URL FUNCTIONS
|--------------------------------------------------------------------------
*/

function siteUrl(string $path = ''): string
{
    return rtrim(SITE_URL, '/') .
        ($path !== '' ? '/' . ltrim($path, '/') : '');
}

function assetUrl(string $path = ''): string
{
    return rtrim(ASSETS_PATH, '/') . '/' . ltrim($path, '/');
}

function imageUrl(string $path = ''): string
{
    $clean = ltrim($path, '/');
    $clean = preg_replace('#^assets/images/#', '', $clean);
    return rtrim(IMAGE_URL, '/') . '/' . $clean;
}

/*
|--------------------------------------------------------------------------
| JSON FUNCTIONS
|--------------------------------------------------------------------------
*/

function loadJson(string $filename, array $default = []): array
{
    $file = DATA_PATH . basename($filename);

    if (!is_file($file)) {
        return $default;
    }

    $content = file_get_contents($file);

    if ($content === false || trim($content) === '') {
        return $default;
    }

    $data = json_decode($content, true);

    return is_array($data) ? $data : $default;
}

function saveJson(string $filename, array $data): bool
{
    $file = DATA_PATH . basename($filename);

    $json = json_encode(
        $data,
        JSON_PRETTY_PRINT |
        JSON_UNESCAPED_UNICODE |
        JSON_UNESCAPED_SLASHES
    );

    if ($json === false) {
        return false;
    }

    return file_put_contents($file, $json, LOCK_EX) !== false;
}

/*
|--------------------------------------------------------------------------
| SECURITY FUNCTIONS
|--------------------------------------------------------------------------
*/

function e(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}

/*
|--------------------------------------------------------------------------
| REDIRECT FUNCTION
|--------------------------------------------------------------------------
*/

function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}
