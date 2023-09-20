<?php

declare(strict_types=1);

namespace Aenginus\Media\Domain\Contracts;

use Illuminate\Database\Eloquent\Model;

interface MultiImageContract
{

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $images
     * @param string $mediaCollection
     *
     * @return void
     */
    public function attach(Model $model, array $images, string $mediaCollection = ''): void;

}
