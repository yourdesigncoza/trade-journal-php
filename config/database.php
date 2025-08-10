<?php

return [
    'host' => $_ENV['MYSQL_HOST'] ?? 'localhost',
    'username' => $_ENV['MYSQL_USER'] ?? 'root', 
    'password' => $_ENV['MYSQL_PASSWORD'] ?? '',
    'database' => $_ENV['MYSQL_DATABASE'] ?? 'trading_journal',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];