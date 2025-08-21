<?php
/**
 * Image Upload Test with Intervention Image
 * Access: http://localhost/Breifs/l3och/ecommerce/test-image-compression.php
 */

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h1>🖼️ Image Upload & Compression Test</h1>";

// Check PHP configuration
echo "<h2>📋 PHP Configuration</h2>";
echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
echo "<ul>";
echo "<li><strong>upload_max_filesize:</strong> " . ini_get('upload_max_filesize') . "</li>";
echo "<li><strong>post_max_size:</strong> " . ini_get('post_max_size') . "</li>";
echo "<li><strong>max_file_uploads:</strong> " . ini_get('max_file_uploads') . "</li>";
echo "<li><strong>memory_limit:</strong> " . ini_get('memory_limit') . "</li>";
echo "</ul>";
echo "</div>";

// Check Intervention Image
echo "<h2>📸 Intervention Image Status</h2>";
echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
try {
    $imageManager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
    echo "<p>✅ <strong>Intervention Image:</strong> Successfully loaded</p>";
    echo "<p><strong>Version:</strong> " . (new ReflectionClass($imageManager))->getFileName() . "</p>";
    
    // Check GD extension
    if (extension_loaded('gd')) {
        $gdInfo = gd_info();
        echo "<p>✅ <strong>GD Extension:</strong> Loaded</p>";
        echo "<p><strong>GD Version:</strong> " . $gdInfo['GD Version'] . "</p>";
        echo "<ul>";
        echo "<li>JPEG Support: " . ($gdInfo['JPEG Support'] ? '✅' : '❌') . "</li>";
        echo "<li>PNG Support: " . ($gdInfo['PNG Support'] ? '✅' : '❌') . "</li>";
        echo "<li>GIF Support: " . ($gdInfo['GIF Read Support'] ? '✅' : '❌') . "</li>";
        echo "<li>WebP Support: " . (function_exists('imagewebp') ? '✅' : '❌') . "</li>";
        echo "</ul>";
    } else {
        echo "<p>❌ <strong>GD Extension:</strong> Not loaded</p>";
    }
    
} catch (Exception $e) {
    echo "<p>❌ <strong>Error:</strong> " . $e->getMessage() . "</p>";
}
echo "</div>";

// Check ImageUploadService
echo "<h2>🔧 ImageUploadService Test</h2>";
echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
try {
    $imageService = app(\App\Services\ImageUploadService::class);
    echo "<p>✅ <strong>ImageUploadService:</strong> Successfully loaded</p>";
    
    // Check constants
    $reflection = new ReflectionClass($imageService);
    $constants = $reflection->getConstants();
    echo "<ul>";
    foreach ($constants as $name => $value) {
        echo "<li><strong>{$name}:</strong> {$value}</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p>❌ <strong>Error:</strong> " . $e->getMessage() . "</p>";
}
echo "</div>";

// Check storage
echo "<h2>📁 Storage Status</h2>";
$storageDir = storage_path('app/public/products');
echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
echo "<ul>";
echo "<li><strong>Storage Path:</strong> {$storageDir}</li>";
echo "<li><strong>Directory Exists:</strong> " . (file_exists($storageDir) ? '✅ Yes' : '❌ No') . "</li>";
echo "<li><strong>Writable:</strong> " . (is_writable($storageDir) ? '✅ Yes' : '❌ No') . "</li>";
echo "</ul>";
echo "</div>";

// Show validation rules
echo "<h2>📝 Current Validation Rules</h2>";
echo "<div style='background: #dcfce7; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
echo "<ul>";
echo "<li><strong>✅ No file size limit:</strong> Images automatically compressed</li>";
echo "<li><strong>✅ Supported formats:</strong> JPEG, PNG, GIF, WebP, BMP, TIFF, SVG</li>";
echo "<li><strong>✅ Auto-resize:</strong> Large images resized to max 2000x2000px</li>";
echo "<li><strong>✅ Quality optimization:</strong> JPEG quality set to 90%</li>";
echo "<li><strong>✅ Format conversion:</strong> BMP/TIFF converted to JPEG for smaller files</li>";
echo "</ul>";
echo "</div>";

echo "<h2>🚀 Features Enabled</h2>";
echo "<div style='background: #dbeafe; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
echo "<ul>";
echo "<li>📤 <strong>Upload any size:</strong> No file size restrictions</li>";
echo "<li>🗜️ <strong>Auto compression:</strong> Large images automatically resized</li>";
echo "<li>🔄 <strong>Format optimization:</strong> Best format selected for file size</li>";
echo "<li>⚡ <strong>Performance:</strong> Optimized for web display</li>";
echo "<li>🛡️ <strong>Security:</strong> File type validation maintained</li>";
echo "</ul>";
echo "</div>";

echo "<h2>📋 Next Steps</h2>";
echo "<div style='background: #fef3c7; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
echo "<ol>";
echo "<li><strong>Test upload:</strong> <a href='/admin/products/create'>Go to Create Product</a></li>";
echo "<li><strong>Try large images:</strong> Upload high-resolution photos (10MB+)</li>";
echo "<li><strong>Check results:</strong> Images should be automatically compressed</li>";
echo "<li><strong>Verify storage:</strong> Check /storage/app/public/products/ for optimized files</li>";
echo "</ol>";
echo "</div>";

echo "<style>
body { font-family: Arial, sans-serif; padding: 20px; max-width: 1000px; margin: 0 auto; }
h1, h2, h3 { color: #1e40af; }
a { color: #0ea5e9; text-decoration: none; }
a:hover { text-decoration: underline; }
</style>";
?>
