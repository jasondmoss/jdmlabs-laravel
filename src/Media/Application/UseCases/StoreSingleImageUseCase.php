<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\UseCases;

use Aenginus\Media\Application\Respositories\Eloquent\StoreSingleImageRepository;
use Aenginus\Media\Domain\Models\ImageModel;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class StoreSingleImageUseCase
{

    private StoreSingleImageRepository $repository;


    /**
     * @param \Aenginus\Media\Application\Respositories\Eloquent\StoreSingleImageRepository $repository
     */
    public function __construct(StoreSingleImageRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param object $requestImage
     *
     * @return void
     */
    public function store(Model $model, object $requestImage): void
    {
        $imageEntity = new ImageEntity($requestImage);

        $storePath = 'images/' . $model->getTable() . '/' . $model->id;
        $filename = $imageEntity->file->getClientOriginalName();

        Storage::disk('public')->put(
            $storePath . '/' . $filename,
            fopen($imageEntity->file->getRealPath(), 'rb+')
        );

        // Resizing.
        $folders = collect(config('jdmlabs.base.images'));
        $responsive_paths = [];

        foreach ($folders as $groups) {
            foreach ($groups as $folder => $size) {
                $base_path = "{$storePath}/{$folder}/{$filename}";

                if (! in_array($folder, [ 'thumb', 'preview' ])) {
                    $responsive_paths[] = [
                        $folder => $base_path
                    ];
                }

                $rImg = Image::make($imageEntity->file)
                    ->fit(
                        $size[1],
                        $size[2],
                        static fn ($constraint) => $constraint->aspectRatio()
                    )
                    ->stream('png');

                Storage::disk('public')->put($base_path, $rImg);
            }
        }

        // Eloquent set-up.
        $image = new ImageModel();
        $image->id = (string)Str::ulid();
        $image->collection = $imageEntity->collection;
        $image->filename = $filename;
        $image->base_path = $storePath;
        $image->responsive_paths = $responsive_paths;
        $image->width = $imageEntity->width;
        $image->height = $imageEntity->height;
        $image->label = $imageEntity->label;
        $image->alt = $imageEntity->alt;
        $image->caption = $imageEntity->caption;
        $image->user_id = $model->user_id;

        // Associate image to requesting entity.
        $image->imageable()->associate($model);

        $this->repository->save($image);
    }

}
