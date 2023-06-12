<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Domain\ClientRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class GetClientProjectsUseCase {

    private ClientRepositoryContract $repository;


    /**
     * @param \App\Client\Domain\ClientRepositoryContract $repository
     */
    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param mixed $client
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke(mixed $client): Collection
    {
        return $this->repository->getClientProjects($client);
    }

}
