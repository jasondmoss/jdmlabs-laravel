<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\UseCases;

use Aenginus\Client\Application\Repositories\Eloquent\StoreRepository;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;

final readonly class StoreUseCase
{

    private StoreRepository $repository;


    /**
     * @param \Aenginus\Client\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $clientEntity
     *
     * @return \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel
     */
    public function store(object $clientEntity): ClientEloquentModel
    {
        return $this->repository->save($clientEntity);
    }

}
