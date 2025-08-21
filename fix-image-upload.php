<?php
// Image Upload Fix Configuration Script

echo "=== Image Upload Fix for E-commerce ===\n\n";

// Check current PHP settings
echo "Current PHP Configuration:\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_file_uploads: " . ini_get('max_file_uploads') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n\n";

// Recommended settings
echo "Recommended PHP Configuration for Image Uploads:\n";
echo "upload_max_filesize = 10M\n";
echo "post_max_size = 64M\n";
echo "max_file_uploads = 20\n";
echo "memory_limit = 256M\n";
echo "max_execution_time = 300\n\n";

// Find php.ini location
echo "Your php.ini file is located at: " . php_ini_loaded_file() . "\n\n";

echo "=== INSTRUCTIONS TO FIX IMAGE UPLOAD ERRORS ===\n\n";

echo "1. Edit your php.ini file (location shown above)\n";
echo "2. Find and update these settings:\n";
echo "   upload_max_filesize = 10M\n";
echo "   post_max_size = 64M\n";
echo "   max_file_uploads = 20\n";
echo "   memory_limit = 256M\n";
echo "   max_execution_time = 300\n\n";

echo "3. Restart your web server (Apache/Nginx)\n";
echo "4. Clear Laravel cache: php artisan cache:clear\n";
echo "5. Re-run this script to verify changes\n\n";

// Check if GD extension is loaded for image processing
if (extension_loaded('gd')) {
    echo "✓ GD Extension is loaded (Good for image processing)\n";
    $gd_info = gd_info();
    echo "  - JPEG Support: " . ($gd_info['JPEG Support'] ? 'Yes' : 'No') . "\n";
    echo "  - PNG Support: " . ($gd_info['PNG Support'] ? 'Yes' : 'No') . "\n";
    echo "  - GIF Support: " . ($gd_info['GIF Read Support'] ? 'Yes' : 'No') . "\n";
} else {
    echo "✗ GD Extension is NOT loaded (Required for image processing)\n";
    echo "  Install GD extension in PHP\n";
}

// Check storage directory permissions
$storage_path = __DIR__ . '/storage/app/public';
if (is_dir($storage_path)) {
    echo "\n✓ Storage directory exists\n";
    if (is_writable($storage_path)) {
        echo "✓ Storage directory is writable\n";
    } else {
        echo "✗ Storage directory is NOT writable\n";
        echo "  Fix permissions: chmod 755 storage/app/public\n";
    }
} else {
    echo "\n✗ Storage directory does not exist\n";
    echo "  Create it: mkdir -p storage/app/public\n";
}

// Check if storage link exists
$public_storage = __DIR__ . '/public/storage';
if (is_link($public_storage) || is_dir($public_storage)) {
    echo "✓ Storage symlink exists\n";
} else {
    echo "✗ Storage symlink missing\n";
    echo "  Create it: php artisan storage:link\n";
}

echo "\n=== END OF DIAGNOSTIC ===\n";
