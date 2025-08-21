<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ImageUploadService
{
    private $imageManager;
    
    public function __construct()
    {
        $this->imageManager = new ImageManager(new GdDriver());
        
        // Set PHP configuration for large uploads at runtime
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '500M');
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 300);
        ini_set('max_input_time', 300);
    }
    
    const MAX_WIDTH = 2000;
    const MAX_HEIGHT = 2000;
    const QUALITY = 90;
    const THUMBNAIL_SIZE = 400;
    // No file size limit - we'll compress images automatically

    /**
     * Process and store multiple product images
     */
    public function storeProductImages(array $images): array
    {
        $imagePaths = [];
        
        foreach ($images as $index => $image) {
            try {
                $imagePath = $this->processAndStoreImage($image, 'products');
                if ($imagePath) {
                    $imagePaths[] = $imagePath;
                }
            } catch (\Exception $e) {
                Log::error("Failed to process image {$index}: " . $e->getMessage());
                // Continue with other images, don't fail completely
            }
        }

        return $imagePaths;
    }

    /**
     * Process and store a single image
     */
    public function processAndStoreImage(UploadedFile $file, string $directory = 'images'): ?string
    {
        try {
            // Validate file
            if (!$this->validateImageFile($file)) {
                return null;
            }

            // Generate unique filename
            $filename = $this->generateUniqueFilename($file);
            
            // Process image based on available extensions
            if (extension_loaded('imagick') || extension_loaded('gd')) {
                return $this->processWithImageLibrary($file, $directory, $filename);
            } else {
                // Fallback: store original file
                return $this->storeOriginalFile($file, $directory, $filename);
            }

        } catch (\Exception $e) {
            Log::error('Image processing failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Validate uploaded image file
     */
    private function validateImageFile(UploadedFile $file): bool
    {
        // Check what formats are actually supported by GD
        $supportedMimes = [];
        
        if (imagetypes() & IMG_PNG) {
            $supportedMimes[] = 'image/png';
        }
        if (imagetypes() & IMG_JPEG) {
            $supportedMimes[] = 'image/jpeg';
        }
        if (imagetypes() & IMG_GIF) {
            $supportedMimes[] = 'image/gif';
        }
        if (imagetypes() & IMG_WEBP) {
            $supportedMimes[] = 'image/webp';
        }
        
        // Always allow JPEG - we'll convert it if GD doesn't support it
        if (!in_array('image/jpeg', $supportedMimes)) {
            $supportedMimes[] = 'image/jpeg';
        }
        
        // Always allow SVG (handled differently)
        $supportedMimes[] = 'image/svg+xml';
        
        Log::info('Supported image formats: ' . implode(', ', $supportedMimes));
        Log::info('Uploaded file format: ' . $file->getMimeType());
        
        if (!in_array($file->getMimeType(), $supportedMimes)) {
            Log::warning("Unsupported MIME type: {$file->getMimeType()}. Supported formats: " . implode(', ', $supportedMimes));
            return false;
        }

        // Special handling for SVG files (they don't have image dimensions)
        if ($file->getMimeType() === 'image/svg+xml') {
            return $this->validateSvgFile($file);
        }

        // Check if file is actually an image
        $imageInfo = @getimagesize($file->getPathname());
        if (!$imageInfo) {
            Log::warning("Invalid image file");
            return false;
        }

        // Check minimum dimensions (optional - remove if not needed)
        if ($imageInfo[0] < 50 || $imageInfo[1] < 50) {
            Log::warning("Image too small: {$imageInfo[0]}x{$imageInfo[1]}, minimum: 50x50");
            return false;
        }

        // No maximum dimension check - we'll resize automatically

        return true;
    }

    /**
     * Validate SVG file
     */
    private function validateSvgFile(UploadedFile $file): bool
    {
        try {
            $content = file_get_contents($file->getPathname());
            
            // Basic SVG validation
            if (strpos($content, '<svg') === false) {
                Log::warning("Invalid SVG file: no <svg> tag found");
                return false;
            }
            
            // Check for potential XSS in SVG
            $dangerous = ['<script', 'javascript:', 'onload=', 'onerror='];
            foreach ($dangerous as $pattern) {
                if (stripos($content, $pattern) !== false) {
                    Log::warning("Potentially dangerous SVG content detected");
                    return false;
                }
            }
            
            return true;
        } catch (\Exception $e) {
            Log::error("Error validating SVG file: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Process image with available image library
     */
    private function processWithImageLibrary(UploadedFile $file, string $directory, string $filename): string
    {
        try {
            // Special handling for JPEG files when GD doesn't support them
            if ($file->getMimeType() === 'image/jpeg' && !(imagetypes() & IMG_JPEG)) {
                return $this->processJpegWithoutGdSupport($file, $directory, $filename);
            }
            
            // Use Intervention Image v3 for processing
            $image = $this->imageManager->read($file->getPathname());
            
            // Get original dimensions
            $width = $image->width();
            $height = $image->height();
            
            // Resize if image is larger than our max dimensions
            if ($width > self::MAX_WIDTH || $height > self::MAX_HEIGHT) {
                $image = $image->scaleDown(self::MAX_WIDTH, self::MAX_HEIGHT);
            }
            
            // Check what image formats are supported by GD
            $hasJpegSupport = function_exists('imagejpeg');
            $hasWebpSupport = function_exists('imagewebp');
            
            // Encode based on original format and GD capabilities
            if ($file->getMimeType() === 'image/png') {
                // Keep PNG for transparency
                $encoded = $image->toPng();
            } elseif ($file->getMimeType() === 'image/gif') {
                // Keep GIF for animations
                $encoded = $image->toGif();
            } elseif ($file->getMimeType() === 'image/webp' && $hasWebpSupport) {
                // Keep WebP format if supported
                $encoded = $image->toWebp(self::QUALITY);
            } elseif ($file->getMimeType() === 'image/jpeg' && $hasJpegSupport) {
                // Keep JPEG if supported
                $encoded = $image->toJpeg(self::QUALITY);
            } else {
                // Fallback to PNG for maximum compatibility
                $encoded = $image->toPng();
                // Update filename extension
                $filename = preg_replace('/\.[^.]+$/', '.png', $filename);
            }
            
            // Store processed image
            $path = "{$directory}/{$filename}";
            Storage::disk('public')->put($path, (string) $encoded);
            
            return $path;
            
        } catch (\Exception $e) {
            Log::error('Intervention Image processing failed: ' . $e->getMessage());
            // Fallback to original file
            return $this->storeOriginalFile($file, $directory, $filename);
        }
    }

    /**
     * Process JPEG files when GD doesn't have JPEG support
     * This method converts JPEG to PNG using native PHP functions
     */
    private function processJpegWithoutGdSupport(UploadedFile $file, string $directory, string $filename): string
    {
        try {
            Log::info('Processing JPEG without GD JPEG support - converting to PNG');
            
            // Read the JPEG file using external tools or convert to PNG
            $tempPath = $file->getPathname();
            
            // Try to use imagecreatefromstring as it might work even without imagecreatefromjpeg
            $imageData = file_get_contents($tempPath);
            $sourceImage = @imagecreatefromstring($imageData);
            
            if (!$sourceImage) {
                Log::error('Cannot process JPEG file - no suitable decoder available');
                throw new \Exception('JPEG format not supported by your server configuration');
            }
            
            // Get original dimensions
            $originalWidth = imagesx($sourceImage);
            $originalHeight = imagesy($sourceImage);
            
            // Calculate new dimensions if resizing is needed
            $newWidth = $originalWidth;
            $newHeight = $originalHeight;
            
            if ($originalWidth > self::MAX_WIDTH || $originalHeight > self::MAX_HEIGHT) {
                $ratio = min(self::MAX_WIDTH / $originalWidth, self::MAX_HEIGHT / $originalHeight);
                $newWidth = (int)($originalWidth * $ratio);
                $newHeight = (int)($originalHeight * $ratio);
            }
            
            // Create a new image
            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Set transparent background for PNG
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
            imagefill($newImage, 0, 0, $transparent);
            
            // Copy and resize
            imagecopyresampled(
                $newImage, $sourceImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $originalWidth, $originalHeight
            );
            
            // Convert filename to PNG
            $filename = preg_replace('/\.[^.]+$/', '.png', $filename);
            
            // Save as PNG
            ob_start();
            imagepng($newImage, null, 8); // PNG compression level 8
            $pngData = ob_get_contents();
            ob_end_clean();
            
            // Clean up memory
            imagedestroy($sourceImage);
            imagedestroy($newImage);
            
            // Store the PNG file
            $path = "{$directory}/{$filename}";
            Storage::disk('public')->put($path, $pngData);
            
            Log::info('Successfully converted JPEG to PNG: ' . $filename);
            return $path;
            
        } catch (\Exception $e) {
            Log::error('JPEG conversion failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Store original file without processing
     */
    private function storeOriginalFile(UploadedFile $file, string $directory, string $filename): string
    {
        $path = "{$directory}/{$filename}";
        $file->storeAs($directory, $filename, 'public');
        return $path;
    }

    /**
     * Generate unique filename for uploaded file
     */
    private function generateUniqueFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        
        // Clean filename
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
        $name = substr($name, 0, 50); // Limit length
        
        // Add timestamp and random string for uniqueness
        $timestamp = now()->format('Y-m-d_H-i-s');
        $random = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 6);
        
        return "{$name}_{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Delete image file
     */
    public function deleteImage(string $path): bool
    {
        try {
            return Storage::disk('public')->delete($path);
        } catch (\Exception $e) {
            Log::error('Failed to delete image: ' . $e->getMessage());
            return false;
        }
    }
}