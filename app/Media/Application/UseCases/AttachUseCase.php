<?php

declare(strict_types=1);

namespace App\Media\Application\UseCases;

use App\Media\Application\Repositories\Eloquent\AttachRepository;
use App\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;

final readonly class AttachUseCase
{

    protected AttachRepository $repository;


    /**
     * @param \App\Media\Application\Repositories\Eloquent\AttachRepository $repository
     */
    public function __construct(AttachRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @param \App\Media\Infrastructure\Entities\ImageEntity $entity
     * @param string $collection
     */
    public function attach(?Model $model, ImageEntity $entity, string $collection): void
    {
        $this->repository->attach($model, $entity, $collection);
    }

}
