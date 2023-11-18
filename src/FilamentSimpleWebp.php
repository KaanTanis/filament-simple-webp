<?php

namespace KaanTanis\FilamentSimpleWebp;

use Intervention\Image\ImageManager;
use League\Flysystem\UnableToCheckFileExistence;

class FilamentSimpleWebp
{
    public static function webp($component, $file, $maxWidth, $optimize)
    {
        $fileType = $file->extension();

        $storeMethod = $component->getVisibility() === 'public'
            ? 'storePubliclyAs'
            : 'storeAs';

        $manager = new ImageManager(['driver' => 'gd']);


        // @fixme this is a workaround for the issue that the file is not uploaded yet
        try {
            if (! $file->exists()) {
                return null;
            }
        } catch (UnableToCheckFileExistence $exception) {
            return null;
        }

        $image = $manager->make($file->path());

        // resize
        if ($image->width() > $maxWidth) {
            $image->resize($maxWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if ($fileType === 'webp') {
            $optimize = 90; // if already webp, optimize more but not too much
        }

        $image->save($file->path(), $optimize, 'webp');

        $filename = config('filament-simple-webp.prefix') . $image->filename.'.webp';

        $file->{$storeMethod}($component->getDirectory(), $filename, $component->getDiskName());

        return $filename;
    }
}
