<?php
define('PREVENT_DIRECT_ACCESS', TRUE);

$system_path = 'scheme';
$application_folder = 'app';
$public_folder = 'public';

define('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('SYSTEM_DIR', ROOT_DIR . $system_path . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . $application_folder . DIRECTORY_SEPARATOR);
define('PUBLIC_DIR', $public_folder);

$allowed_origins = [
    'http://localhost:5173',
    'https://lavalust-frontend-cmjw.onrender.com'
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$origin_is_allowed = in_array($origin, $allowed_origins, true);

if ($origin_is_allowed) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Vary: Origin');
}

if (
    ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS' &&
    strpos($_SERVER['REQUEST_URI'] ?? '', '/api/') !== false
) {
    if ($origin_is_allowed) {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Vary: Origin');
        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    }

    http_response_code(204);
    exit;
}

require_once SYSTEM_DIR . 'kernel/LavaLust.php';
