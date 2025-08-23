<?php

use App\Models\Product;
use Illuminate\Support\Str;

// Test creating a product directly with is_customizable = true
$productData = [
    'name' => 'Direct Test Customizable Product',
    'description' => 'This product was created directly to test customization feature',
    'price' => 149.99,
    'category_id' => 2,
    'stock' => 5,
    'rating' => 0,
    'review_count' => 0,
    'is_featured' => false,
    'is_customizable' => true, // Set to true
    'slug' => Str::slug('Direct Test Customizable Product'),
];

$product = Product::create($productData);

echo "Product created:\n";
echo "ID: " . $product->id . "\n";
echo "Name: " . $product->name . "\n";
echo "Is Customizable: " . ($product->is_customizable ? 'true' : 'false') . "\n";

// Verify by fetching from database
$fetched = Product::find($product->id);
echo "\nFetched from DB:\n";
echo "Is Customizable: " . ($fetched->is_customizable ? 'true' : 'false') . "\n";
