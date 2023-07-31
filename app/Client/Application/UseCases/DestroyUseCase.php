<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Application\Repositories\Eloquent\DestroyRepository;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;

final readonly class DestroyUseCase
{

    protected DestroyRepository $repository;


    /**
     * @param \App\Client\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     *
     * @return void
     */
    public function delete(ClientEloquentModel $client): void
    {
        $this->repository->delete($client);
    }

}
