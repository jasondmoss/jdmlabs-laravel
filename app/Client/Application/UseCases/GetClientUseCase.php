<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Domain\ClientRepositoryContract;
use App\Client\Infrastructure\ClientModel;

class GetClientUseCase {

    private ClientRepositoryContract $repository;


    /**
     * @param \App\Client\Domain\ClientRepositoryContract $repository
     */
    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return \App\Client\Infrastructure\ClientModel
     */
    public function __invoke(string $id): ClientModel
    {
        return $this->repository->get($id);
    }

}
