<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Infrastructure\Client;
use App\Client\Infrastructure\Repository\SaveRepository;
use App\Client\Interface\ClientFormRequest;

class SaveClientUseCase
{

    protected SaveRepository $repository;


    /**
     * @param \App\Client\Infrastructure\Repository\SaveRepository $repository
     */
    public function __construct(SaveRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Client\Interface\ClientFormRequest $data
     *
     * @return \App\Client\Infrastructure\Client
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(ClientFormRequest $data): Client
    {
        return $this->repository->save($data);
    }

}
