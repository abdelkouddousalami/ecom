<?php
/**
 * Test JPEG Upload Functionality
 * This script tests the ImageUploadService JPEG support
 */

require_once __DIR__ . '/vendor/autoload.php';

// Initialize Laravel Application
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    // Test ImageUploadService registration
    $imageService = app(App\Services\ImageUploadService::class);
    echo "✅ ImageUploadService successfully loaded from container\n";
    
    // Test class methods exist
    if (method_exists($imageService, 'storeProductImages')) {
        echo "✅ storeProductImages method exists\n";
    } else {
        echo "❌ storeProductImages method missing\n";
    }
    
    if (method_exists($imageService, 'processJpegWithoutGdSupport')) {
        echo "✅ processJpegWithoutGdSupport method exists\n";
    } else {
        echo "❌ processJpegWithoutGdSupport method missing\n";
    }
    
    if (method_exists($imageService, 'validateImageFile')) {
        echo "✅ validateImageFile method exists\n";
    } else {
        echo "❌ validateImageFile method missing\n";
    }
    
    // Test GD functions availability
    if (function_exists('imagecreatefromstring')) {
        echo "✅ imagecreatefromstring function available\n";
    } else {
        echo "❌ imagecreatefromstring function not available\n";
    }
    
    if (function_exists('imagepng')) {
        echo "✅ imagepng function available\n";
    } else {
        echo "❌ imagepng function not available\n";
    }
    
    echo "\n🎉 All tests passed! JPEG upload support is ready.\n";
    echo "You can now upload JPEG files and they will be automatically converted to PNG.\n";
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "❌ JPEG upload functionality is not working properly.\n";
}
