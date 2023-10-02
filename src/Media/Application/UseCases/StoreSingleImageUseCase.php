<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\UseCases;

use Aenginus\Media\Application\Respositories\Eloquent\StoreSingleImageRepository;
use Aenginus\Media\Domain\Models\ImageModel;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

        $imageEntityName = "{$model->id}."
            . $imageEntity->file->getClientOriginalExtension();

        $imageEntityPath = 'public/images/' . $model->getTable();

        $imageEntity->file->storeAs($imageEntityPath, $imageEntityName);

        $image = new ImageModel();

        $image->id = (string) Str::ulid();
        $image->collection = $imageEntity->collection;
        $image->filename = $imageEntityName;
        $image->filepath = 'storage/images/' . $model->getTable() . '/';
        $image->width = $imageEntity->width;
        $image->height = $imageEntity->height;
        $image->label = $imageEntity->label;
        $image->alt = $imageEntity->alt;
        $image->caption = $imageEntity->caption;
        $image->user_id = $model->user_id;

        $image->imageable()->associate($model);
        $this->repository->save($image);

        /*$folders = collect(config('jdmlabs.base.responsive_images'));

        foreach ($folders as $dir) {
            $responsive_path = $base_path . '/' . $model->id . '/' . $dir;

            if (! Storage::exists($responsive_path)) {
                Storage::makeDirectory($responsive_path);
            }

            $breakpoint = match ($dir) {
                'mobile' => 640,
                'tablet' => 760,
                'desktop' => 1024,
                'desktop_lg' => 1200,
                'desktop_xl' => 1500
            };

            $image->resize($breakpoint, null, static function ($constraint) {
                $constraint->aspectRatio();
            })->save("{$path_base}/{$imageModel->hash}", 85);
        }*/
    }

}
