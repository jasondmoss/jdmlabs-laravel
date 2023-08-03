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
     * @param object $clientEntity
     *
     * @return \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel
     */
    public function store(object $clientEntity): ClientEloquentModel
    {
        return $this->repository->save($clientEntity);
    }

}
