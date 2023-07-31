<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Application\Repositories\Eloquent\StoreRepository;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

final readonly class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Client\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $data
     *
     * @return \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel
     */
    public function store(object $data): ClientEloquentModel
    {
        return $this->repository->save($data);
    }

}
