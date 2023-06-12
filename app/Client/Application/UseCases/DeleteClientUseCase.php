<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Domain\ClientRepositoryContract;

class DeleteClientUseCase {

    protected ClientRepositoryContract $repository;


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
     * @return void
     */
    public function __invoke(string $id): void
    {
        $this->repository->delete($id);
    }

}
