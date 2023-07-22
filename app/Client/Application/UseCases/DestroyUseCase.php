<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Infrastructure\Client;
use App\Client\Infrastructure\Repositories\DestroyRepository;

final readonly class DestroyUseCase
{

    protected DestroyRepository $repository;


    /**
     * @param \App\Client\Infrastructure\Repositories\DestroyRepository $repository
     */
    public function __construct(DestroyRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Client\Infrastructure\Client $client
     *
     * @return void
     */
    public function delete(Client $client): void
    {
        $this->repository->delete($client);
    }

}
