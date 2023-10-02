<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Respositories\Eloquent;

use Aenginus\Media\Domain\Contracts\StoreSingleImageContract;
use Aenginus\Media\Domain\Models\ImageModel;

class StoreSingleImageRepository implements StoreSingleImageContract
{

    /**
     * @param \Aenginus\Media\Domain\Models\ImageModel $image
     *
     * @return void
     */
    public function save(ImageModel $image): void
    {
        $image->save();
    }

}
