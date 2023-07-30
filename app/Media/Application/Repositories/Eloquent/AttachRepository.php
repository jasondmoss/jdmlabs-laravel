<?php

declare(strict_types=1);

namespace App\Media\Application\Repositories\Eloquent;

use App\Media\Domain\Contracts\AttachContract;
use App\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AttachRepository implements AttachContract
{

    /**
     * @inheritDoc
     */
    public function attach(
        ?Model $model,
        ImageEntity $entity,
        string $collection = ''
    ): void
    {
        try {
            // Delete any existing media attached to this model.
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
                ->toMediaCollection($collection);
        } catch (FileDoesNotExist|FileIsTooBig $exception) {
            report($exception);
        }
    }

}
