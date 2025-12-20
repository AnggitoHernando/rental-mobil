<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(
            new Driver()
        );
    }

    public function resizeToJpeg($file, int $width, int $height, int $quality = 80)
    {
        return $this->manager
            ->read($file)
            ->scaleDown($width, $height)
            ->toJpeg($quality);
    }
}
