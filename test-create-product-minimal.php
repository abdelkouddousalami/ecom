<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;
use App\Models\Category;

echo "=== Testing Product Creation ===\n";

try {
    // Check if categories exist
    $categories = Category::count();
    echo "Available categories: {$categories}\n";
    
    if ($categories == 0) {
        echo "No categories found. Creating a test category...\n";
        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'A test category for testing product creation',
            'slug' => 'test-category',
            'image' => null
        ]);
        echo "Test category created with ID: {$category->id}\n";
    } else {
        $category = Category::first();
        echo "Using existing category: {$category->name} (ID: {$category->id})\n";
    }
    
    // Try to create a product without images
    echo "\nTesting product creation without images...\n";
    $product = Product::create([
        'name' => 'Test Product Without Images',
        'description' => 'This is a test product created without any images to test the nullable image field.',
        'price' => 99.99,
        'original_price' => 149.99,
        'category_id' => $category->id,
        'image' => null, // Testing nullable field
        'stock' => 10,
        'rating' => 0,
        'review_count' => 0,
        'slug' => 'test-product-without-images-' . time(),
        'is_featured' => false,
        'is_active' => true,
        'tags' => 'test, product',
        'specifications' => 'Test specifications'
    ]);
    
    echo "✅ Product created successfully!\n";
    echo "Product ID: {$product->id}\n";
    echo "Product Name: {$product->name}\n";
    echo "Product Image: " . ($product->image ?? 'NULL') . "\n";
    
    // Clean up - delete the test product
    $product->delete();
    echo "Test product deleted.\n";
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}

echo "\n=== Test Complete ===\n";
