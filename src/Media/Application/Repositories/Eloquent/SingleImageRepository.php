<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Repositories\Eloquent;

use Aenginus\Media\Domain\Contracts\SingleImageContract;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

final class SingleImageRepository implements SingleImageContract
{

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Aenginus\Media\Infrastructure\Entities\ImageEntity $entity
     * @param string $mediaCollection
     *
     * @return void
     */
    public function attach(Model $model, ImageEntity $entity, string $mediaCollection = ''): void
    {
        try {
            // Delete any existing image.
            foreach ($model->media as $media) {
                $media->delete();
            }

            $model->addMedia($entity->file)
                ->withCustomProperties([
                    'label' => $entity->label,
                    'alt' => $entity->alt,
                    'caption' => $entity->caption,
                    'width' => $entity->width,
                    'height' => $entity->height
                ])
                ->withResponsiveImages()
                ->toMediaCollection($mediaCollection);
        } catch (FileDoesNotExist|FileIsTooBig $exception) {
            report($exception);
        }
    }

}
