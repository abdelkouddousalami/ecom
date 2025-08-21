<?php
// Create a simple JPEG test image using pure PHP (without JPEG GD functions)
$image = imagecreate(300, 300);
$bg = imagecolorallocate($image, 255, 200, 150);
$text_color = imagecolorallocate($image, 100, 50, 0);
imagestring($image, 5, 90, 140, 'TEST JPEG', $text_color);

// Save as PNG first, then we'll simulate a JPEG upload
imagepng($image, 'public/test-jpeg-converted.png');
imagedestroy($image);

echo 'Created test image: public/test-jpeg-converted.png (simulates JPEG conversion)';
?>
