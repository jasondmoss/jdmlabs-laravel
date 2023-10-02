<?php

declare(strict_types=1);

namespace Aenginus\Media\Domain\Contracts;

use Aenginus\Media\Domain\Models\ImageModel;

interface StoreSingleImageContract
{

    public function save(ImageModel $image): void;

}
