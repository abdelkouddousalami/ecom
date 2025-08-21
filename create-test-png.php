<?php
// Create a simple PNG test image
$image = imagecreate(300, 300);
$bg = imagecolorallocate($image, 200, 220, 255);
$text_color = imagecolorallocate($image, 0, 50, 100);
imagestring($image, 5, 100, 140, 'TEST PNG', $text_color);
imagepng($image, 'public/test-png-image.png');
imagedestroy($image);
echo 'Created test PNG image: public/test-png-image.png';
?>
