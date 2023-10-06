<?php

declare(strict_types=1);

namespace Aenginus\Shared\Intervention\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Dynamic implements FilterInterface
{

    /**
     * @inheritDoc
     */
    public function applyFilter(Image $image): Image
    {
        // w = width in px
        $width = request()->input('w');
        $quality = request()->input('q') ?? 90;

        $image->resize($width, null, static function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg', $quality);

        return $image;
    }

}
