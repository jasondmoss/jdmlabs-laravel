<?php

declare(strict_types=1);

namespace Aenginus\Media\Domain\Contracts;

use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;

interface SingleImageContract
{

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Aenginus\Media\Infrastructure\Entities\ImageEntity $entity
     * @param string $mediaCollection
     *
     * @return void
     */
    public function attach(Model $model, ImageEntity $entity, string $mediaCollection = ''): void;

}
