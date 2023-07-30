<?php

declare(strict_types=1);

namespace App\Media\Domain\Contracts;

use App\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;

interface AttachContract
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @param \App\Media\Infrastructure\Entities\ImageEntity $entity
     * @param string $collection
     *
     * @return void
     */
    public function attach(?Model $model, ImageEntity $entity, string $collection = ''): void;

}
