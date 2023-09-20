<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\UseCases;

use Aenginus\Media\Application\Repositories\Eloquent\SingleImageRepository;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Exception;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

final readonly class SingleImageUseCase
{

    private SingleImageRepository $repository;


    /**
     * @param \Aenginus\Media\Application\Repositories\Eloquent\SingleImageRepository $repository
     */
    public function __construct(SingleImageRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param object $image
     * @param string $mediaCollection
     *
     * @return void
     */
    public function attach(Model $model, object $image, string $mediaCollection = ''): void
    {
        $imageEntity = new ImageEntity($image);

        try {
            $this->repository->attach($model, $imageEntity, $mediaCollection);
        } catch (Exception) {
            throw new RuntimeException('Image could not  be saved.');
        }
    }

}
