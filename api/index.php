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

try {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // If running on Vercel, redirect storage to /tmp since the main filesystem is read-only
    if (isset($_ENV['VERCEL'])) {
        $storagePath = '/tmp/storage';
        $app->useStoragePath($storagePath);
        
        // Ensure all required framework directories exist for views, cache, sessions, and logs
        foreach (['framework/views', 'framework/cache/data', 'framework/sessions', 'logs'] as $dir) {
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
