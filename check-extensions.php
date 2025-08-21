<?php
$extensions = get_loaded_extensions();
foreach($extensions as $ext) {
    if (stripos($ext, 'gd') !== false || stripos($ext, 'image') !== false || stripos($ext, 'magick') !== false) {
        echo $ext . PHP_EOL;
    }
}

// Also check for ImageMagick specifically
if (extension_loaded('imagick')) {
    echo "ImageMagick is available!" . PHP_EOL;
    $imagick = new Imagick();
    $formats = $imagick->queryFormats();
    echo "ImageMagick supports: " . count($formats) . " formats" . PHP_EOL;
    if (in_array('JPEG', $formats)) {
        echo "ImageMagick supports JPEG!" . PHP_EOL;
    }
} else {
    echo "ImageMagick is NOT available" . PHP_EOL;
}
?>
