<?php

declare(strict_types=1);

namespace Aenginus\Media\Domain\Contracts;

use Aenginus\Media\Domain\Models\ImageModel;
use Illuminate\Database\Eloquent\Collection;

interface StoreSingleImageContract
{

    // public function save(ImageModel $image): void;
    public function save(Collection $collection): void;

}
