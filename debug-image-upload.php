<?php
// Simple test for debugging image upload issues

require_once 'vendor/autoload.php';

// Load Laravel bootstrap
require_once 'bootstrap/app.php';

use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

echo "<h1>Debug Image Upload Issue</h1>";

// Test 1: Check if ImageUploadService can be instantiated
echo "<h2>Test 1: ImageUploadService Instantiation</h2>";
try {
    $imageService = new ImageUploadService();
    echo "✅ ImageUploadService created successfully<br>";
} catch (Exception $e) {
    echo "❌ Error creating ImageUploadService: " . $e->getMessage() . "<br>";
    exit;
}

// Test 2: Check GD capabilities
echo "<h2>Test 2: GD Capabilities</h2>";
$gdInfo = gd_info();
echo "GD Version: " . $gdInfo['GD Version'] . "<br>";

$formats = [];
if (imagetypes() & IMG_PNG) $formats[] = 'PNG';
if (imagetypes() & IMG_JPEG) $formats[] = 'JPEG';  
if (imagetypes() & IMG_GIF) $formats[] = 'GIF';
if (imagetypes() & IMG_WEBP) $formats[] = 'WebP';

echo "Supported formats: " . implode(', ', $formats) . "<br>";

// Test 3: Check if directories exist
echo "<h2>Test 3: Storage Directories</h2>";
$dirs = [
    'storage/app/public/products',
    'public/storage/products'
];

foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        echo "✅ $dir exists (writable: " . (is_writable($dir) ? 'yes' : 'no') . ")<br>";
    } else {
        echo "❌ $dir does not exist<br>";
        try {
            mkdir($dir, 0755, true);
            echo "✅ Created $dir<br>";
        } catch (Exception $e) {
            echo "❌ Failed to create $dir: " . $e->getMessage() . "<br>";
        }
    }
}

// Test 4: Test with existing test image
echo "<h2>Test 4: Test Image Processing</h2>";
if (file_exists('public/test-image.png')) {
    echo "Found test image: public/test-image.png<br>";
    
    try {
        // Create a mock UploadedFile for testing
        $tempFile = tempnam(sys_get_temp_dir(), 'test_image');
        copy('public/test-image.png', $tempFile);
        
        // This is a simplified test - in real scenario we'd need proper UploadedFile
        echo "✅ Test image copied to temp location<br>";
        
        // Test the image processing logic directly
        $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $image = $manager->read('public/test-image.png');
        echo "✅ Image loaded with Intervention Image<br>";
        echo "Image dimensions: " . $image->width() . "x" . $image->height() . "<br>";
        
        // Test encoding
        $encoded = $image->toPng();
        echo "✅ Image encoded successfully<br>";
        
        unlink($tempFile);
        
    } catch (Exception $e) {
        echo "❌ Error processing test image: " . $e->getMessage() . "<br>";
        echo "Stack trace:<br><pre>" . $e->getTraceAsString() . "</pre>";
    }
} else {
    echo "❌ No test image found<br>";
}

// Test 5: Check Laravel configuration
echo "<h2>Test 5: Laravel Configuration</h2>";
try {
    echo "APP_DEBUG: " . (config('app.debug') ? 'true' : 'false') . "<br>";
    echo "Storage disk 'public' path: " . storage_path('app/public') . "<br>";
    echo "Public storage link: " . public_path('storage') . "<br>";
} catch (Exception $e) {
    echo "❌ Error accessing Laravel config: " . $e->getMessage() . "<br>";
}

echo "<h2>Debug Complete</h2>";
echo "<p>If all tests pass, the issue might be in the form submission or validation logic.</p>";
?>
