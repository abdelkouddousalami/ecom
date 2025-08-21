<?php

require_once __DIR__ . '/vendor/autoload.php';

// Initialize Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing ImageUploadService...\n";

try {
    $service = new App\Services\ImageUploadService();
    echo "✓ ImageUploadService created successfully!\n";
} catch (Exception $e) {
    echo "✗ Error creating ImageUploadService: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nTesting StoreProductRequest...\n";

try {
    $request = new App\Http\Requests\StoreProductRequest();
    echo "✓ StoreProductRequest created successfully!\n";
} catch (Exception $e) {
    echo "✗ Error creating StoreProductRequest: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nTesting AdminController instantiation...\n";

try {
    $controller = new App\Http\Controllers\AdminController();
    echo "✓ AdminController created successfully!\n";
} catch (Exception $e) {
    echo "✗ Error creating AdminController: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nAll tests completed.\n";
