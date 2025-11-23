<?php

/**
 * Script untuk setup database testing
 * 
 * Usage: php tests/setup-test-db.php
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$dbName = 'skillhub_test';
$host = '127.0.0.1';
$username = 'root';
$password = '';

try {
    // Connect to MySQL without selecting database
    $pdo = new PDO("mysql:host={$host}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    
    echo "✓ Database '{$dbName}' created successfully!\n";
    echo "\nNow you can run: php artisan test\n";
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "\nPlease create database '{$dbName}' manually in phpMyAdmin.\n";
    exit(1);
}

