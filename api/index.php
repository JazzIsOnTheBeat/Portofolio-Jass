<?php

/**
 * Vercel Serverless Function Entry Point
 * 
 * This file bootstraps the Laravel application for Vercel's
 * serverless PHP runtime (vercel-php). All HTTP requests are
 * routed here via vercel.json configuration.
 */

// Set the working directory to the project root
chdir(__DIR__ . '/..');

if (isset($_GET['test_connection'])) {
    header('Content-Type: text/plain');
    echo "Testing Database Connection...\n";
    try {
        $pdo = new PDO('mysql:host='.$_ENV['DB_HOST'].';port='.$_ENV['DB_PORT'].';dbname='.$_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [
            PDO::ATTR_TIMEOUT => 3
        ]);
        echo "DB OK\n";
    } catch (\Exception $e) {
        echo "DB FAILED: " . $e->getMessage() . "\n";
    }

    echo "Testing Redis Connection...\n";
    try {
        $fp = fsockopen('tls://' . $_ENV['REDIS_HOST'], $_ENV['REDIS_PORT'], $errno, $errstr, 3);
        if (!$fp) {
            echo "REDIS FAILED: $errstr ($errno)\n";
        } else {
            echo "REDIS OK\n";
            fclose($fp);
        }
    } catch (\Exception $e) {
        echo "REDIS FAILED: " . $e->getMessage() . "\n";
    }
    exit;
}

try {
    require __DIR__ . '/../vendor/autoload.php';

    // Set paths before bootstrapping the app
    if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
        $storagePath = '/tmp/storage';
        $_ENV['APP_SERVICES_CACHE'] = "$storagePath/bootstrap/cache/services.php";
        $_ENV['APP_PACKAGES_CACHE'] = "$storagePath/bootstrap/cache/packages.php";
        $_ENV['APP_CONFIG_CACHE'] = "$storagePath/bootstrap/cache/config.php";
        $_ENV['APP_ROUTES_CACHE'] = "$storagePath/bootstrap/cache/routes.php";
        $_ENV['APP_EVENTS_CACHE'] = "$storagePath/bootstrap/cache/events.php";
        $_ENV['VIEW_COMPILED_PATH'] = "$storagePath/framework/views";
    }

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // If running on Vercel, redirect storage to /tmp since the main filesystem is read-only
    if (isset($_ENV['VERCEL'])) {
        $storagePath = '/tmp/storage';
        $app->useStoragePath($storagePath);
        
        // Ensure all required framework directories exist for views, cache, sessions, and logs
        foreach (['bootstrap/cache', 'framework/views', 'framework/cache/data', 'framework/sessions', 'logs'] as $dir) {
            if (!is_dir("$storagePath/$dir")) {
                mkdir("$storagePath/$dir", 0777, true);
            }
        }
    }

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Fatal Error on Vercel</h1>";
    echo "<pre>";
    echo "Message: " . $e->getMessage() . "\n\n";
    echo "File: " . $e->getFile() . " on line " . $e->getLine() . "\n\n";
    echo "Stack Trace:\n" . $e->getTraceAsString();
    echo "</pre>";
    exit(1);
}
