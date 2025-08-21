<?php

require_once __DIR__ . '/vendor/autoload.php';

// Initialize Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Product Creation Flow ===\n\n";

// Test 1: Check if all required classes exist and work
echo "1. Testing class dependencies:\n";

try {
    $service = new App\Services\ImageUploadService();
    echo "   ✓ ImageUploadService: OK\n";
} catch (Exception $e) {
    echo "   ✗ ImageUploadService: " . $e->getMessage() . "\n";
}

try {
    $categories = App\Models\Category::all();
    echo "   ✓ Category model: OK (" . $categories->count() . " categories)\n";
} catch (Exception $e) {
    echo "   ✗ Category model: " . $e->getMessage() . "\n";
}

try {
    $products = App\Models\Product::all();
    echo "   ✓ Product model: OK (" . $products->count() . " products)\n";
} catch (Exception $e) {
    echo "   ✗ Product model: " . $e->getMessage() . "\n";
}

// Test 2: Test validation rules
echo "\n2. Testing validation rules:\n";

try {
    $validator = Illuminate\Support\Facades\Validator::make([
        'name' => 'Test Product',
        'description' => 'This is a test product description',
        'price' => 100,
        'category_id' => 1,
        'stock' => 10,
        'images' => []
    ], [
        'name' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'images' => 'required|array|min:1|max:10',
        'stock' => 'required|integer|min:0',
    ]);
    
    if ($validator->fails()) {
        echo "   ✓ Validation working (expected to fail for missing images)\n";
        echo "     Errors: " . implode(', ', $validator->errors()->all()) . "\n";
    } else {
        echo "   ✗ Validation not working as expected\n";
    }
} catch (Exception $e) {
    echo "   ✗ Validation error: " . $e->getMessage() . "\n";
}

// Test 3: Check storage permissions
echo "\n3. Testing storage setup:\n";

$storagePath = storage_path('app/public');
$publicPath = public_path('storage');

echo "   Storage path: " . $storagePath . "\n";
echo "   Exists: " . (is_dir($storagePath) ? '✓' : '✗') . "\n";
echo "   Writable: " . (is_writable($storagePath) ? '✓' : '✗') . "\n";
echo "   Public link: " . $publicPath . "\n";
echo "   Link exists: " . (is_link($publicPath) || is_dir($publicPath) ? '✓' : '✗') . "\n";

// Test 4: Check route exists
echo "\n4. Testing routes:\n";

try {
    $url = route('admin.store-product');
    echo "   ✓ Store product route: " . $url . "\n";
} catch (Exception $e) {
    echo "   ✗ Store product route: " . $e->getMessage() . "\n";
}

try {
    $url = route('admin.create-product');
    echo "   ✓ Create product route: " . $url . "\n";
} catch (Exception $e) {
    echo "   ✗ Create product route: " . $e->getMessage() . "\n";
}

echo "\n=== Test completed ===\n";
echo "\nIf you're still getting errors when adding products, please:\n";
echo "1. Check the browser's developer console for JavaScript errors\n";
echo "2. Check the network tab to see the exact HTTP response\n";
echo "3. Ensure you're selecting at least one image file\n";
echo "4. Make sure the form fields are filled correctly\n";
