<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

// Simulate the exact form data that would be sent
$formData = [
    'name' => 'Test Select Product',
    'description' => 'This is a test product created with select dropdown set to customizable',
    'price' => '149.99',
    'category_id' => '2',
    'stock' => '5',
    'customizable' => '1', // Selected "Yes - Allow customization"
    '_token' => 'test'
];

echo "Testing select dropdown logic:\n";
echo "Form data customizable value: " . $formData['customizable'] . "\n";
echo "Is string '1': " . ($formData['customizable'] === '1' ? 'true' : 'false') . "\n";
echo "Equals '1' (loose): " . ($formData['customizable'] == '1' ? 'true' : 'false') . "\n";

// Test the controller logic
$customizable_value = $formData['customizable'] ?? '0';
$is_customizable = $customizable_value == '1';

echo "Will be customizable: " . ($is_customizable ? 'true' : 'false') . "\n";

// Test creating the product directly
use App\Models\Product;
use Illuminate\Support\Str;

$product = Product::create([
    'name' => $formData['name'],
    'description' => $formData['description'],
    'price' => $formData['price'],
    'category_id' => $formData['category_id'],
    'stock' => $formData['stock'],
    'is_customizable' => $is_customizable,
    'slug' => Str::slug($formData['name']),
    'rating' => 0,
    'review_count' => 0,
    'is_featured' => false,
]);

echo "\nProduct created:\n";
echo "ID: " . $product->id . "\n";
echo "Name: " . $product->name . "\n";
echo "Is Customizable: " . ($product->is_customizable ? 'true' : 'false') . "\n";

// Verify by fetching
$fetched = Product::find($product->id);
echo "\nFetched from DB:\n";
echo "Is Customizable: " . ($fetched->is_customizable ? 'true' : 'false') . "\n";
