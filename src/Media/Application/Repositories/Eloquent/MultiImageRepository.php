<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Repositories\Eloquent;

use Aenginus\Media\Domain\Contracts\MultiImageContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

final class MultiImageRepository implements MultiImageContract
{

    public UploadedFile $file;

    /**
     * @inheritDoc
     */
    public function attach(Model $model, array $images, string $mediaCollection = ''): void
    {
        try {
            $model->clearMediaCollection($mediaCollection);

            foreach ($images as $image) {
                dump($image);
                /*if ($image->file !== null) {
                    // dump($image->file);
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
                }*/
            }
            exit();
        } catch (FileDoesNotExist|FileIsTooBig $exception) {
            report($exception);
        }
    }

}
