<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Application\Repositories\Eloquent\UpdateRepository;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Client\Infrastructure\Entities\ClientEntity;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Client\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     * @param \App\Client\Infrastructure\Entities\ClientEntity $entity
     *
     * @return \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel
     */
    public function update(ClientEloquentModel $client, ClientEntity $entity): ClientEloquentModel
    {
        return $this->repository->update($client, $entity);
    }

}
