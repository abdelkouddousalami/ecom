<?php
require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

echo "Looking for test products...\n";

// Find test products (those with 'test' in slug or name)
$testProducts = Product::where('slug', 'like', '%test%')
    ->orWhere('name', 'like', '%test%')
    ->orWhere('slug', 'like', '%demo%')
    ->orWhere('name', 'like', '%demo%')
    ->orWhere('slug', 'like', '%sample%')
    ->orWhere('name', 'like', '%sample%')
    ->orWhere('slug', 'like', '%placeholder%')
    ->orWhere('name', 'like', '%placeholder%')
    ->get();

if ($testProducts->count() > 0) {
    echo "Found " . $testProducts->count() . " test product(s):\n";
    
    foreach ($testProducts as $product) {
        echo "- ID: {$product->id}, Name: {$product->name}, Slug: {$product->slug}\n";
    }
    
    echo "\nDeleting test products...\n";
    
    foreach ($testProducts as $product) {
        // Delete associated images first
        if ($product->images) {
            foreach ($product->images as $image) {
                $image->delete();
            }
        }
        
        // Delete the product
        $product->delete();
        echo "Deleted: {$product->name} (slug: {$product->slug})\n";
    }
    
    echo "\n✅ All test products removed successfully!\n";
} else {
    echo "No test products found.\n";
}

echo "\nRemaining products:\n";
$allProducts = Product::all(['id', 'name', 'slug']);
foreach ($allProducts as $product) {
    echo "- {$product->name} (slug: {$product->slug})\n";
}
?>
