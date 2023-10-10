<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Respositories\Eloquent;

use Aenginus\Media\Domain\Contracts\StoreSingleImageContract;
use Illuminate\Database\Eloquent\Collection;

class StoreSingleImageRepository implements StoreSingleImageContract
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
