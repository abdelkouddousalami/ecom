<?php
// Fix broken product images script

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

require_once __DIR__ . '/vendor/autoload.php';

// Initialize Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Product Images Diagnostic & Fix Tool ===\n\n";

// Check all products
$products = Product::with('images')->get();
$brokenImages = [];
$fixedImages = [];

echo "Checking {$products->count()} products for image issues...\n\n";

foreach ($products as $product) {
    echo "Product: {$product->name} (ID: {$product->id})\n";
    
    // Check main image
    if ($product->image) {
        if (!Storage::disk('public')->exists($product->image)) {
            echo "  ✗ Main image missing: {$product->image}\n";
            $brokenImages[] = ['type' => 'main', 'product' => $product->id, 'path' => $product->image];
            
            // Try to set first available image as main
            $firstImage = $product->images()->first();
            if ($firstImage && Storage::disk('public')->exists($firstImage->image_path)) {
                $product->update(['image' => $firstImage->image_path]);
                echo "  ✓ Fixed: Set first available image as main\n";
                $fixedImages[] = $product->id;
            }
        } else {
            echo "  ✓ Main image OK\n";
        }
    } else {
        echo "  ! No main image set\n";
        // Try to set first available image as main
        $firstImage = $product->images()->first();
        if ($firstImage && Storage::disk('public')->exists($firstImage->image_path)) {
            $product->update(['image' => $firstImage->image_path]);
            echo "  ✓ Fixed: Set first available image as main\n";
            $fixedImages[] = $product->id;
        }
    }
    
    // Check gallery images
    foreach ($product->images as $image) {
        if (!Storage::disk('public')->exists($image->image_path)) {
            echo "  ✗ Gallery image missing: {$image->image_path}\n";
            $brokenImages[] = ['type' => 'gallery', 'product' => $product->id, 'image_id' => $image->id, 'path' => $image->image_path];
            
            // Remove broken image record
            $image->delete();
            echo "  ✓ Removed broken image record\n";
        } else {
            echo "  ✓ Gallery image OK: {$image->image_path}\n";
        }
    }
    
    echo "\n";
}

echo "=== SUMMARY ===\n";
echo "Total products checked: {$products->count()}\n";
echo "Broken images found: " . count($brokenImages) . "\n";
echo "Products with fixes applied: " . count(array_unique($fixedImages)) . "\n\n";

if (count($brokenImages) > 0) {
    echo "=== BROKEN IMAGES DETAILS ===\n";
    foreach ($brokenImages as $broken) {
        echo "- {$broken['type']} image missing: {$broken['path']}\n";
    }
    echo "\n";
}

// Check storage permissions and setup
echo "=== STORAGE SETUP CHECK ===\n";

$publicStoragePath = storage_path('app/public');
$publicLinkPath = public_path('storage');

echo "Storage path: {$publicStoragePath}\n";
echo "Public link: {$publicLinkPath}\n";

if (is_dir($publicStoragePath)) {
    echo "✓ Storage directory exists\n";
    if (is_writable($publicStoragePath)) {
        echo "✓ Storage directory is writable\n";
    } else {
        echo "✗ Storage directory is NOT writable\n";
        echo "  Fix: chmod 755 {$publicStoragePath}\n";
    }
} else {
    echo "✗ Storage directory missing\n";
    echo "  Fix: mkdir -p {$publicStoragePath}\n";
}

if (is_link($publicLinkPath) || is_dir($publicLinkPath)) {
    echo "✓ Storage symlink exists\n";
} else {
    echo "✗ Storage symlink missing\n";
    echo "  Fix: php artisan storage:link\n";
}

echo "\n=== RECOMMENDATIONS ===\n";

if (count($brokenImages) > 0) {
    echo "1. Some product images are missing from storage\n";
    echo "2. Re-upload missing images through the admin panel\n";
    echo "3. Consider implementing automatic image backup\n";
}

echo "4. Ensure PHP upload limits are adequate:\n";
echo "   - upload_max_filesize = 10M\n";
echo "   - post_max_size = 64M\n";
echo "   - max_file_uploads = 20\n";
echo "5. Use the improved image upload system for better validation\n";
echo "6. Consider implementing image optimization for better performance\n";

echo "\n=== DONE ===\n";
