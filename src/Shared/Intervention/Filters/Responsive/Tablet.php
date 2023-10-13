<?php

declare(strict_types=1);

namespace Aenginus\Shared\Intervention\Filters\Responsive;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Tablet implements FilterInterface
{

    /**
     * @inheritDoc
     */
    public function applyFilter(Image $image, array $size = [800, 650]): Image
    {
        return $image->fit($size[0], $size[1]);
    }

}
