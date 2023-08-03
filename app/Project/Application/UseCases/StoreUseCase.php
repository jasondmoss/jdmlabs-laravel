<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Application\Repositories\Eloquent\StoreRepository;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

final readonly class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Project\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $projectEntity
     *
     * @return \App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel
     */
    public function store(object $projectEntity): ProjectEloquentModel
    {
        return $this->repository->save($projectEntity);
    }

}
