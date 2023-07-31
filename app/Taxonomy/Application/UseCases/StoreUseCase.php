<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\UseCases;

use App\Taxonomy\Application\Repositories\Eloquent\StoreRepository;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

final class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Taxonomy\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $data
     *
     * @return \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function store(object $data): CategoryEloquentModel
    {
        return $this->repository->save($data);
    }

}
