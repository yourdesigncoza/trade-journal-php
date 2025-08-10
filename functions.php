<?php

// Determine the base URL dynamically
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

// Get the base path - this handles subdirectory installations
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$scriptDir = dirname($scriptName);

// If we're in a subdirectory, use it; otherwise use empty string
if ($scriptDir !== '/' && $scriptDir !== '\\' && $scriptDir !== '.') {
    $basePath = $scriptDir;
} else {
    $basePath = '';
}

// Domain and path constants
define('WEB_ROOT', $_ENV['APP_URL'] ?? $protocol . $host . $basePath);
define('ASSETS_URL', WEB_ROOT . '/public/assets');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMAGES_URL', ASSETS_URL . '/images');
define('INCLUDES_URL', WEB_ROOT . '/includes');

// Application constants
define('APP_NAME', 'Trading Journal');
define('APP_VERSION', date('YmdHis'));

// Helper functions
function asset_url($path) {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

function css_url($filename) {
    return CSS_URL . '/' . ltrim($filename, '/') . '?ver=' . APP_VERSION;
}

function js_url($filename) {
    return JS_URL . '/' . ltrim($filename, '/') . '?ver=' . APP_VERSION;
}

function includes_url($path) {
    return INCLUDES_URL . '/' . ltrim($path, '/');
}

function web_url($path = '') {
    return WEB_ROOT . '/' . ltrim($path, '/');
}