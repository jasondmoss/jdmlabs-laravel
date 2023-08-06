<?php

declare(strict_types=1);

namespace Aenginus\Media\Domain\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ShowcaseImagesContract
{

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $showcaseImages
     * @param string $mediaCollection
     *
     * @return void
     */
    public function attach(
        Model $model,
        array $showcaseImages,
        string $mediaCollection = ''
    ): void;

}
