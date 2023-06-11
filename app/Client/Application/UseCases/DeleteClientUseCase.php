<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Domain\ClientRepositoryContract;

class DeleteClientUseCase {

    protected ClientRepositoryContract $repository;


    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(string $id): void
    {
        $this->repository->deleteClient($id);
    }

}
