<?php
/**
 * Debug Image Upload Issues
 * Access: http://localhost/Breifs/l3och/ecommerce/debug-upload.php
 */

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h1>🔍 Upload Debug Test</h1>";

// Check if this is a POST request (file upload test)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_image'])) {
    echo "<h2>📥 Processing Upload</h2>";
    echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
    
    try {
        $file = $_FILES['test_image'];
        
        echo "<p><strong>File Details:</strong></p>";
        echo "<ul>";
        echo "<li><strong>Name:</strong> " . $file['name'] . "</li>";
        echo "<li><strong>Size:</strong> " . number_format($file['size']) . " bytes</li>";
        echo "<li><strong>Type:</strong> " . $file['type'] . "</li>";
        echo "<li><strong>Error:</strong> " . $file['error'] . "</li>";
        echo "</ul>";
        
        if ($file['error'] === UPLOAD_ERR_OK) {
            echo "<p>✅ <strong>File uploaded successfully to temporary location</strong></p>";
            
            // Test ImageUploadService
            $imageService = app(\App\Services\ImageUploadService::class);
            echo "<p>✅ <strong>ImageUploadService loaded</strong></p>";
            
            // Create a Laravel UploadedFile object
            $uploadedFile = new \Illuminate\Http\UploadedFile(
                $file['tmp_name'],
                $file['name'],
                $file['type'],
                $file['error'],
                true
            );
            
            echo "<p>✅ <strong>UploadedFile object created</strong></p>";
            
            // Test the image processing
            $result = $imageService->processAndStoreImage($uploadedFile, 'test');
            
            if ($result) {
                echo "<p>✅ <strong>Image processed successfully!</strong></p>";
                echo "<p><strong>Stored at:</strong> " . $result . "</p>";
                
                // Check if file exists
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($result)) {
                    echo "<p>✅ <strong>File exists in storage</strong></p>";
                    $fileSize = \Illuminate\Support\Facades\Storage::disk('public')->size($result);
                    echo "<p><strong>Final size:</strong> " . number_format($fileSize) . " bytes</p>";
                } else {
                    echo "<p>❌ <strong>File not found in storage</strong></p>";
                }
            } else {
                echo "<p>❌ <strong>Image processing failed</strong></p>";
            }
            
        } else {
            echo "<p>❌ <strong>Upload error:</strong> ";
            switch ($file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    echo "File exceeds upload_max_filesize directive";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "File exceeds MAX_FILE_SIZE directive";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "File was only partially uploaded";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "No file was uploaded";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo "Missing temporary folder";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo "Failed to write file to disk";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo "A PHP extension stopped the file upload";
                    break;
                default:
                    echo "Unknown error code: " . $file['error'];
            }
            echo "</p>";
        }
        
    } catch (Exception $e) {
        echo "<p>❌ <strong>Exception:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>File:</strong> " . $e->getFile() . "</p>";
        echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>";
    }
    
    echo "</div>";
}

echo "<h2>🧪 Upload Test Form</h2>";
echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
echo "<form method='POST' enctype='multipart/form-data'>";
echo "<p><strong>Select an image to test:</strong></p>";
echo "<input type='file' name='test_image' accept='image/*' required>";
echo "<br><br>";
echo "<button type='submit' style='background: #3b82f6; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;'>Test Upload</button>";
echo "</form>";
echo "</div>";

echo "<h2>📊 Current Configuration</h2>";
echo "<div style='background: #f8fafc; padding: 15px; border-radius: 8px; margin: 10px 0;'>";
echo "<ul>";
echo "<li><strong>upload_max_filesize:</strong> " . ini_get('upload_max_filesize') . "</li>";
echo "<li><strong>post_max_size:</strong> " . ini_get('post_max_size') . "</li>";
echo "<li><strong>max_file_uploads:</strong> " . ini_get('max_file_uploads') . "</li>";
echo "<li><strong>memory_limit:</strong> " . ini_get('memory_limit') . "</li>";
echo "<li><strong>max_execution_time:</strong> " . ini_get('max_execution_time') . "</li>";
echo "</ul>";
echo "</div>";

echo "<style>
body { font-family: Arial, sans-serif; padding: 20px; max-width: 1000px; margin: 0 auto; }
h1, h2, h3 { color: #1e40af; }
</style>";
?>
