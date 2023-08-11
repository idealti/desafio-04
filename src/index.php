<?php

require __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['REQUEST_URI'];

if (str_contains($path, '?')) {
    $path = explode('?', $path)[0];
}

$path = ($path == '/') ? '/login' : $path;
$routes = require __DIR__ . '/config/routes.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

session_start();

if (!isset($_SESSION['logged']) && in_array($path, ['/tasks', '/edit-task'])) {
    http_response_code(401);
    header('Location: /login');
    exit();
}

$controller = (new $routes[$path])->handle();