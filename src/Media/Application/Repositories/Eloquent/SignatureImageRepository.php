<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Repositories\Eloquent;

use Aenginus\Media\Domain\Contracts\SignatureImageContract;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

final class SignatureImageRepository implements SignatureImageContract
{

    /**
     * @inheritDoc
     */
    public function attach(Model $model, ImageEntity $entity, string $mediaCollection = 'signatures'): void
    {
        try {
            // Delete any existing signature image.
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
