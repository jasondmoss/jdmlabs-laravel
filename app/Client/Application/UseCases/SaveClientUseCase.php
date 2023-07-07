<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Domain\ClientRepositoryContract;
use App\Client\Infrastructure\Client;
use App\Client\Interface\ClientFormRequest;

class SaveClientUseCase
{

    protected ClientRepositoryContract $repository;


    /**
     * @param \App\Client\Domain\ClientRepositoryContract $repository
     */
    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Client\Interface\ClientFormRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function __invoke(ClientFormRequest $data): Client
    {
        return $this->repository->save($data);
    }

}
