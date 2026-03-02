<?php

// Danh sách route hợp lệ (whitelist)
$routes = [
    'home' => 'pages/home.php',
    'contact' => 'pages/contact.php',
    'about' => 'pages/about.php'
];

// Lấy page từ URL
$page = $_GET['page'] ?? 'home';

// Nếu route tồn tại -> include
if (array_key_exists($page, $routes)) {
    include $routes[$page];
} else {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
}