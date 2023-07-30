<?php

declare(strict_types=1);

namespace App\Media\Infrastructure\Repositories;

use App\Media\Domain\Contracts\AttachContract;
use App\Media\Infrastructure\Entities\ImageEntity;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AttachRepository implements AttachContract
{

    /**
     * @throws \Exception
     */
    public function attach($model, $data, $collection = '')
    {
        try {
            // Delete any existing media attached to this model.
            foreach ($model->media as $media) {
                $media->delete();
            }

            $imageEntity = new ImageEntity($data);

            $model->addMedia($imageEntity->file)
                ->withCustomProperties([
                    'label' => $imageEntity->label,
                    'alt' => $imageEntity->alt,
                    'caption' => $imageEntity->caption,
                    'width' => $imageEntity->width,
                    'height' => $imageEntity->height
                ])
                ->withResponsiveImages()
                ->toMediaCollection($collection);
        } catch (FileDoesNotExist|FileIsTooBig $exception) {
            report($exception);

            return false;
        }
    }

}
