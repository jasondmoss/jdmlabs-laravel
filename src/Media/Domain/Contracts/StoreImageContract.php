<?php

declare(strict_types=1);

namespace Aenginus\Media\Domain\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface StoreImageContract
{
    public function save(Collection $collection): void;
}
