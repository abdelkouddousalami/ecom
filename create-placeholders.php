<?php
// Create placeholder images script

use Illuminate\Support\Facades\Storage;

require_once __DIR__ . '/vendor/autoload.php';

// Initialize Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Creating Placeholder Images ===\n\n";

// Create a simple placeholder image function
function createPlaceholderImage($width, $height, $text) {
    // Create image
    $img = imagecreatetruecolor($width, $height);
    
    // Colors
    $bg_color = imagecolorallocate($img, 240, 240, 240); // Light gray
    $text_color = imagecolorallocate($img, 100, 100, 100); // Dark gray
    $border_color = imagecolorallocate($img, 200, 200, 200); // Border gray
    
    // Fill background
    imagefill($img, 0, 0, $bg_color);
    
    // Add border
    imagerectangle($img, 0, 0, $width-1, $height-1, $border_color);
    
    // Add text
    $font_size = 5;
    $text_width = strlen($text) * imagefontwidth($font_size);
    $text_height = imagefontheight($font_size);
    
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2;
    
    imagestring($img, $font_size, $x, $y, $text, $text_color);
    
    // Save to buffer
    ob_start();
    imagejpeg($img, null, 80);
    $imageData = ob_get_contents();
    ob_end_clean();
    
    // Clean up
    imagedestroy($img);
    
    return $imageData;
}

// Create placeholder images for different product types
$placeholders = [
    'placeholder-bracelet.jpg' => 'Bracelet Image',
    'placeholder-watch.jpg' => 'Watch Image',
    'placeholder-giftpack.jpg' => 'Gift Pack Image',
    'placeholder-chain.jpg' => 'Chain Image',
    'placeholder-smartwatch.jpg' => 'Smart Watch Image',
    'placeholder-charm.jpg' => 'Charm Image',
    'placeholder-rings.jpg' => 'Ring Set Image',
    'placeholder-dress.jpg' => 'Dress Watch Image',
];

foreach ($placeholders as $filename => $text) {
    $imageData = createPlaceholderImage(500, 500, $text);
    
    if ($imageData) {
        Storage::disk('public')->put($filename, $imageData);
        echo "✓ Created: {$filename}\n";
    } else {
        echo "✗ Failed to create: {$filename}\n";
    }
}

// Also create generic placeholder for missing detail images
for ($i = 1; $i <= 20; $i++) {
    $filename = "images/products/img/detaille{$i}.jpg";
    $imageData = createPlaceholderImage(500, 500, "Product Image {$i}");
    
    if ($imageData) {
        Storage::disk('public')->put($filename, $imageData);
        echo "✓ Created: {$filename}\n";
    } else {
        echo "✗ Failed to create: {$filename}\n";
    }
}

echo "\n=== Placeholder Images Created ===\n";
echo "All missing product images now have placeholder images.\n";
echo "You can now upload proper images through the admin panel.\n";
