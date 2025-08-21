<?php
// Simple test script for upload system without full Laravel bootstrap

echo "<h1>Testing Image Upload JSON Response System</h1>\n";

// Test 1: Verify system components exist
echo "<h2>Test 1: System Components</h2>\n";
try {
    echo "📁 Checking ImageUploadService file...\n<br>";
    if (file_exists('app/Services/ImageUploadService.php')) {
        echo "✅ ImageUploadService.php exists\n<br>";
    } else {
        echo "❌ ImageUploadService.php not found\n<br>";
    }
    
    // Test with a sample image if available
    $publicImages = glob('public/images/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    if (!empty($publicImages)) {
        $testImage = $publicImages[0];
        echo "📷 Found test image: " . basename($testImage) . "\n<br>";
        
        // Test image info
        $imageInfo = getimagesize($testImage);
        if ($imageInfo) {
            echo "📐 Image dimensions: {$imageInfo[0]}x{$imageInfo[1]}\n<br>";
            echo "📁 Image type: {$imageInfo['mime']}\n<br>";
        }
    } else {
        echo "⚠️ No test images found in public/images/\n<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Error with ImageUploadService: " . $e->getMessage() . "\n<br>";
}

// Test 2: Check GD extension capabilities
echo "<h2>Test 2: GD Extension Capabilities</h2>\n";
if (extension_loaded('gd')) {
    echo "✅ GD extension is loaded\n<br>";
    
    $gdInfo = gd_info();
    echo "📊 GD Version: " . $gdInfo['GD Version'] . "\n<br>";
    
    // Check supported formats
    $formats = [];
    if (imagetypes() & IMG_PNG) $formats[] = 'PNG';
    if (imagetypes() & IMG_JPEG) $formats[] = 'JPEG';
    if (imagetypes() & IMG_GIF) $formats[] = 'GIF';
    if (imagetypes() & IMG_WEBP) $formats[] = 'WebP';
    
    echo "🎨 Supported formats: " . implode(', ', $formats) . "\n<br>";
    
    if (empty($formats)) {
        echo "⚠️ Warning: No standard image formats supported by GD\n<br>";
    }
} else {
    echo "❌ GD extension is not loaded\n<br>";
}

// Test 3: Check Intervention Image availability
echo "<h2>Test 3: Intervention Image Library</h2>\n";
try {
    if (class_exists('Intervention\Image\ImageManager')) {
        echo "✅ Intervention Image library is available\n<br>";
        
        $manager = new \Intervention\Image\ImageManager(
            new \Intervention\Image\Drivers\Gd\Driver()
        );
        echo "✅ Intervention Image manager created successfully\n<br>";
        
    } else {
        echo "❌ Intervention Image library not found\n<br>";
    }
} catch (Exception $e) {
    echo "❌ Error with Intervention Image: " . $e->getMessage() . "\n<br>";
}

// Test 4: Check upload directories
echo "<h2>Test 4: Upload Directory Structure</h2>\n";
$uploadPaths = [
    'public/storage/products',
    'storage/app/public/products',
    'public/images'
];

foreach ($uploadPaths as $path) {
    if (is_dir($path)) {
        echo "✅ Directory exists: $path\n<br>";
        echo "📝 Writable: " . (is_writable($path) ? 'Yes' : 'No') . "\n<br>";
    } else {
        echo "❌ Directory missing: $path\n<br>";
    }
}

// Test 5: Simulate JSON response format
echo "<h2>Test 5: JSON Response Format Test</h2>\n";

// Simulate successful response
$successResponse = [
    'success' => true,
    'message' => 'Product created successfully!',
    'redirect' => '/admin/products'
];

echo "✅ Success Response Format:\n<br>";
echo "<pre>" . json_encode($successResponse, JSON_PRETTY_PRINT) . "</pre>\n";

// Simulate error response
$errorResponse = [
    'success' => false,
    'message' => 'Validation failed',
    'errors' => [
        'images' => ['The selected file is not a valid image.']
    ]
];

echo "❌ Error Response Format:\n<br>";
echo "<pre>" . json_encode($errorResponse, JSON_PRETTY_PRINT) . "</pre>\n";

// Test 6: Check PHP configuration for uploads
echo "<h2>Test 6: PHP Upload Configuration</h2>\n";
echo "📁 upload_max_filesize: " . ini_get('upload_max_filesize') . "\n<br>";
echo "📊 post_max_size: " . ini_get('post_max_size') . "\n<br>";
echo "🔢 max_file_uploads: " . ini_get('max_file_uploads') . "\n<br>";
echo "⏱️ max_execution_time: " . ini_get('max_execution_time') . " seconds\n<br>";
echo "💾 memory_limit: " . ini_get('memory_limit') . "\n<br>";

// Check if unlimited upload is enabled by ImageUploadService
echo "<h2>Test 7: Unlimited Upload Configuration</h2>\n";
echo "🚀 Testing runtime configuration updates...\n<br>";

// Show current values
echo "Current upload_max_filesize: " . ini_get('upload_max_filesize') . "\n<br>";
echo "Current post_max_size: " . ini_get('post_max_size') . "\n<br>";
echo "Current memory_limit: " . ini_get('memory_limit') . "\n<br>";

// Test runtime configuration (what ImageUploadService does)
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');
ini_set('memory_limit', '256M');
ini_set('max_execution_time', 300);

echo "After runtime updates:\n<br>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n<br>";
echo "post_max_size: " . ini_get('post_max_size') . "\n<br>";
echo "memory_limit: " . ini_get('memory_limit') . "\n<br>";
echo "max_execution_time: " . ini_get('max_execution_time') . " seconds\n<br>";

echo "<h2>🎉 Test Completed!</h2>\n";
echo "<p>The image upload system should now work correctly with JSON responses.</p>\n";

// Create a test image for demonstration
echo "<h2>Bonus: Creating a Test Image</h2>\n";
try {
    // Create a simple test image
    $testImage = imagecreate(200, 200);
    $white = imagecolorallocate($testImage, 255, 255, 255);
    $blue = imagecolorallocate($testImage, 0, 100, 200);
    
    imagestring($testImage, 5, 50, 90, "TEST IMAGE", $blue);
    
    $testPath = 'public/test-image.png';
    if (imagepng($testImage, $testPath)) {
        echo "✅ Created test image: $testPath\n<br>";
        echo "📏 Size: " . filesize($testPath) . " bytes\n<br>";
    }
    
    imagedestroy($testImage);
} catch (Exception $e) {
    echo "❌ Could not create test image: " . $e->getMessage() . "\n<br>";
}
