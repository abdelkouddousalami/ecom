<?php
// Simple test to view orders page with data
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/orders', 'GET');
$response = $kernel->handle($request);

echo $response->getContent();
