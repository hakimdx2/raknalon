<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    private ImageManager $manager;

    public function __construct()
    {
        // Use GD driver by default
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Convert an image to WebP format and optimize quality
     * 
     * @param string $sourcePath Full path to source image
     * @param string|null $destinationPath Optional destination path. Defaults to source filename + .webp
     * @param int $quality Quality 0-100 (default 80)
     * @return string The path to the saved WebP image
     */
    public function convertToWebp(string $sourcePath, ?string $destinationPath = null, int $quality = 80): string
    {
        if (!file_exists($sourcePath)) {
            throw new \Exception("Image source not found: $sourcePath");
        }

        if ($destinationPath === null) {
            $pathInfo = pathinfo($sourcePath);
            $destinationPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
        }

        $image = $this->manager->read($sourcePath);
        
        // Encode to WebP with specified quality (optimization)
        $encoded = $image->toWebp($quality);
        
        $encoded->save($destinationPath);

        return $destinationPath;
    }

    /**
     * Optimize an existing image (resize if needed, adjust quality)
     */
    public function optimize(string $path, int $quality = 80, ?int $maxWidth = null): void
    {
        if (!file_exists($path)) {
            return;
        }

        $image = $this->manager->read($path);

        if ($maxWidth && $image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        // Save back to same path with optimized quality
        // Detect format from extension or content
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        
        if ($extension === 'webp') {
             $image->toWebp($quality)->save($path);
        } elseif ($extension === 'png') {
             $image->toPng()->save($path); // PNG doesn't support quality in toPng() in all drivers same way, but usually it optimizes compression
        } elseif (in_array($extension, ['jpg', 'jpeg'])) {
             $image->toJpeg($quality)->save($path);
        }
    }
}
