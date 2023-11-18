<?php

namespace KaanTanis\FilamentSimpleWebp;

use Intervention\Image\ImageManager;

class FilamentSimpleWebp
{
    public static function webp($component, $file, $maxWidth, $optimize): string
    {
        $fileType = $file->extension();

        $storeMethod = $component->getVisibility() === 'public'
            ? 'storePubliclyAs'
            : 'storeAs';

        $manager = new ImageManager(['driver' => 'gd']);

        $image = $manager->make($file->path());

        // resize
        if ($image->width() > $maxWidth) {
            $image->resize($maxWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if ($fileType === 'webp') {
            $optimize = 90;
        }

        $image->save($file->path(), $optimize, 'webp');

        $filename = $image->filename.'.webp';

        $file->{$storeMethod}($component->getDirectory(), $filename, $component->getDiskName());

        return $filename;
    }
}
