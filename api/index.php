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

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
