<?php

declare(strict_types=1);

namespace Aenginus\Shared\Intervention\Filters\Responsive;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Desktop implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function applyFilter(Image $image, array $size = [1200, 650]): Image
    {
        return $image->fit($size[0], $size[1]);
    }
}
