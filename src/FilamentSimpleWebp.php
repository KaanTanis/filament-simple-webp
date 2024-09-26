<?php

namespace KaanTanis\FilamentSimpleWebp;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use League\Flysystem\UnableToCheckFileExistence;

class FilamentSimpleWebp
{
    /**
     * Converts the given image to webp format, resizes if necessary, and stores it.
     *
     * @param  object  $component
     * @param  object  $file
     */
    public static function convertToWebp($component, $file, int $maxWidth, int $optimize): ?string
    {
        if (! self::isFileUploaded($file)) {
            return null;
        }

        $imageManager = new ImageManager(new Driver);
        $image = $imageManager->read($file->path());

        self::resizeImage($image, $maxWidth);
        self::setOptimizationLevel($file->extension(), $optimize);

        $webpFileName = self::generateWebpFileName($file);
        $image->save($file->path(), $optimize, 'webp');

        return self::storeImage($component, $file, $webpFileName);
    }

    /**
     * Checks if the file exists.
     *
     * @param  object  $file
     */
    private static function isFileUploaded($file): bool
    {
        try {
            return $file->exists();
        } catch (UnableToCheckFileExistence $exception) {
            return false;
        }
    }

    /**
     * Resizes the image if it exceeds the max width.
     *
     * @param  object  $image
     */
    private static function resizeImage($image, int $maxWidth): void
    {
        $image->scaleDown(width: $maxWidth);
    }

    private static function setOptimizationLevel(string $fileType, int &$optimize): void
    {
        if ($fileType === 'webp') {
            $optimize = 100;
        }
    }

    /**
     * Generates a filename for the webp image.
     *
     * @param  object  $file
     */
    private static function generateWebpFileName($file): string
    {
        $rand = uniqid();

        return config('filament-simple-webp.prefix').$rand.'.webp';
    }

    /**
     * Stores the image on the designated disk and directory.
     *
     * @param  object  $component
     * @param  object  $file
     */
    private static function storeImage($component, $file, string $fileName): string
    {
        $storeMethod = $component->getVisibility() === 'public' ? 'storePubliclyAs' : 'storeAs';
        $file->{$storeMethod}($component->getDirectory(), $fileName, $component->getDiskName());

        return $fileName;
    }
}
