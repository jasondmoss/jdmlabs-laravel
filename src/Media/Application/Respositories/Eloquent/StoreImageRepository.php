<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Respositories\Eloquent;

use Aenginus\Media\Domain\Contracts\StoreImageContract;
use Illuminate\Database\Eloquent\Collection;

class StoreImageRepository implements StoreImageContract
{
    /**
     * @param \Illuminate\Database\Eloquent\Collection $collection
     *
     * @return void
     */
    public function save(Collection $collection): void
    {
        $collection->map(static fn ($image) => $image->save());
    }
}
