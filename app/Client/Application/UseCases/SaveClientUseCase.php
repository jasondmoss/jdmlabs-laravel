<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Domain\ClientRepositoryContract;
use App\Client\Infrastructure\Client;
use App\Shared\Interface\EntryFormRequest;

class SaveClientUseCase {

    protected ClientRepositoryContract $repository;


    /**
     * @param \App\Client\Domain\ClientRepositoryContract $repository
     */
    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     */
    public function __invoke(EntryFormRequest $data): Client
    {
        return $this->repository->save($data);
    }

}
