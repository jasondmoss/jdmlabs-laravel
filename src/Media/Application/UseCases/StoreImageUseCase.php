<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\UseCases;

use Aenginus\Media\Application\Respositories\Eloquent\StoreImageRepository;
use Aenginus\Media\Domain\Models\ImageModel;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class StoreImageUseCase
{
    private StoreImageRepository $repository;


    /**
     * @param \Aenginus\Media\Application\Respositories\Eloquent\StoreImageRepository $repository
     */
    public function __construct(StoreImageRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $requestedImages
     *
     * @return void
     */
    public function store(Model $model, array $requestedImages): void
    {
        $imagesCollection = new Collection();

        foreach ($requestedImages as $requestedImage) {
            $imageEntity = new ImageEntity($requestedImage);
            $storePath = 'images/' . $model->getTable() . '/' . $model->id . '/';

            $filename = $imageEntity->file->getClientOriginalName();

            // Store the original uploaded file.
            Storage::disk('public')->put(
                $storePath . '/' . $imageEntity->type . '/' . $filename,
                fopen($imageEntity->file->getRealPath(), 'rb+')
            );

            $folders = collect(config('jdmlabs.base.images.' . $requestedImage->type));

            // Resize images and store each into a separate folder.
            foreach ($folders as $folder => $constraint) {
                $resizePath = "{$storePath}/{$imageEntity->type}/{$folder}/{$filename}";

                $resizedImage = Image::make($imageEntity->file)->fit(
                    $constraint[1],
                    $constraint[2],
                    static fn ($constraint) => $constraint->aspectRatio()
                )->stream('png');

                Storage::disk('public')->put($resizePath, $resizedImage);
            }

            // Eloquent set-up.
            $image = new ImageModel();
            $image->id = (string) Str::ulid();
            $image->type = $imageEntity->type;
            $image->filename = $filename;
            $image->width = $imageEntity->width;
            $image->height = $imageEntity->height;
            $image->label = $imageEntity->label;
            $image->alt = $imageEntity->alt;
            $image->caption = $imageEntity->caption;
            $image->user_id = $model->user_id;

            // Associate image to requesting entity.
            $image->imageable()->associate($model);

            // Collect.
            $imagesCollection->push($image);
        }
        //        exit();

        // Send to repository.
        $this->repository->save($imagesCollection);
    }
}
