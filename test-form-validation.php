<?php

require_once __DIR__ . '/vendor/autoload.php';

// Initialize Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Product Creation Form ===\n";

try {
    // Check if we can get a CSRF token
    echo "1. Testing route access...\n";
    $createUrl = url('admin/create-product');
    echo "Create product URL: $createUrl\n";
    
    // Test StoreProductRequest validation
    echo "\n2. Testing StoreProductRequest validation (without images)...\n";
    
    // Simulate a request without images
    $validator = \Validator::make([
        'name' => 'Test Product',
        'description' => 'This is a test product description',
        'price' => 99.99,
        'category_id' => 1, // Assuming category exists
        'stock' => 10,
        // No images provided
    ], (new \App\Http\Requests\StoreProductRequest())->rules());
    
    if ($validator->fails()) {
        echo "❌ Validation failed (this is expected if images are required):\n";
        foreach ($validator->errors()->all() as $error) {
            echo "   - $error\n";
        }
    } else {
        echo "✅ Validation passed without images!\n";
    }
    
    // Test with images array but empty
    echo "\n3. Testing with empty images array...\n";
    $validator2 = \Validator::make([
        'name' => 'Test Product',
        'description' => 'This is a test product description',
        'price' => 99.99,
        'category_id' => 1,
        'stock' => 10,
        'images' => [], // Empty array
    ], (new \App\Http\Requests\StoreProductRequest())->rules());
    
    if ($validator2->fails()) {
        echo "❌ Validation failed with empty images array:\n";
        foreach ($validator2->errors()->all() as $error) {
            echo "   - $error\n";
        }
    } else {
        echo "✅ Validation passed with empty images array!\n";
    }
    
    // Check database structure
    echo "\n4. Checking products table structure...\n";
    $table = DB::select("PRAGMA table_info(products)");
    foreach ($table as $column) {
        if ($column->name === 'image') {
            echo "Image column: name={$column->name}, type={$column->type}, nullable=" . ($column->notnull ? 'NO' : 'YES') . "\n";
            break;
        }
    }
    
    echo "\n5. Testing product creation directly...\n";
    $category = \App\Models\Category::first();
    if (!$category) {
        echo "❌ No categories found. Please create a category first.\n";
    } else {
        $product = \App\Models\Product::create([
            'name' => 'Test Product Via Script',
            'description' => 'Test product created via diagnostic script',
            'price' => 49.99,
            'category_id' => $category->id,
            'image' => null,
            'stock' => 5,
            'slug' => 'test-product-via-script-' . time(),
        ]);
        
        echo "✅ Product created successfully!\n";
        echo "Product ID: {$product->id}, Name: {$product->name}\n";
        
        // Clean up
        $product->delete();
        echo "Test product deleted.\n";
    }
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}

echo "\n=== Diagnostic Complete ===\n";
