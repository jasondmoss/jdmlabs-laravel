<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Repositories\Eloquent;

use Aenginus\Media\Domain\Contracts\ShowcaseImagesContract;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

final class ShowcaseImagesRepository implements ShowcaseImagesContract
{

    /**
     * @inheritDoc
     */
    public function attach(
        Model $model,
        array $showcaseImages,
        string $mediaCollection = 'showcase'
    ): void
    {
        try {
            // Delete any existing signature image.
            foreach ($model->media as $media) {
//                $media->delete();
                $media->clearMediaCollection($mediaCollection);
            }

            foreach ($showcaseImages as $image) {
                $model->addMedia($image->file)
                    ->withCustomProperties([
                        'label' => $image->label,
                        'alt' => $image->alt,
                        'caption' => $image->caption,
                        'width' => $image->width,
                        'height' => $image->height
                    ])
                    ->withResponsiveImages()
                    ->toMediaCollection($mediaCollection);
            }
        } catch (FileDoesNotExist|FileIsTooBig $exception) {
            report($exception);
        }
    }

}
