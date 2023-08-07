<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\UseCases;

use Aenginus\Client\Application\Repositories\Eloquent\UpdateRepository;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;

final readonly class UpdateUseCase
{

    private UpdateRepository $repository;


    /**
     * @param \Aenginus\Client\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     * @param \Aenginus\Client\Infrastructure\Entities\ClientEntity $entity
     *
     * @return \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel
     */
    public function update(ClientEloquentModel $client, ClientEntity $entity): ClientEloquentModel
    {
        return $this->repository->update($client, $entity);
    }

}
