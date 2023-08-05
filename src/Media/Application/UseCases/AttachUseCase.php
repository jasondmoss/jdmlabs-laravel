<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\UseCases;

use Aenginus\Media\Application\Repositories\Eloquent\AttachRepository;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;

final readonly class AttachUseCase
{

    private AttachRepository $repository;


    /**
     * @param \Aenginus\Media\Application\Repositories\Eloquent\AttachRepository $repository
     */
    public function __construct(AttachRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @param \Aenginus\Media\Infrastructure\Entities\ImageEntity $entity
     * @param string $collection
     */
    public function attach(Model|null $model, ImageEntity $entity, string $collection): void
    {
        $this->repository->attach($model, $entity, $collection);
    }

}
