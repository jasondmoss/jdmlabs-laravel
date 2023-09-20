<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\UseCases;

use Aenginus\Media\Application\Repositories\Eloquent\MultiImageRepository;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Exception;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

final readonly class MultiImageUseCase
{

    private MultiImageRepository $repository;


    /**
     * @param \Aenginus\Media\Application\Repositories\Eloquent\MultiImageRepository $repository
     */
    public function __construct(MultiImageRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $images
     * @param string $mediaCollection
     */
    public function attach(Model $model, array $images, string $mediaCollection = ''): void
    {
        $multiImages = [];

        foreach ($images as $image) {
            $multiImages[] = new ImageEntity((object) $image);
        }

        try {
            $this->repository->attach($model, $multiImages, $mediaCollection);
        } catch (Exception) {
            throw new RuntimeException('Signature image could not  be saved.');
        }
    }

}
