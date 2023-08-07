<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\UseCases;

use Aenginus\Client\Application\Repositories\Eloquent\DestroyRepository;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;

final readonly class DestroyUseCase
{

    private DestroyRepository $repository;


    /**
     * @param \Aenginus\Client\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     *
     * @return void
     */
    public function delete(ClientEloquentModel $client): void
    {
        $this->repository->delete($client);
    }

}
