<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\UseCases;

use Aenginus\Project\Application\Repositories\Eloquent\StoreRepository;
use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;

final readonly class StoreUseCase
{

    private StoreRepository $repository;


    /**
     * @param \Aenginus\Project\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $projectEntity
     *
     * @return \Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel
     */
    public function store(object $projectEntity): ProjectEloquentModel
    {
        return $this->repository->save($projectEntity);
    }

}
