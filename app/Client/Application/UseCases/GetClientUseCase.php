<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Infrastructure\Client;
use App\Client\Infrastructure\Repository\GetRepository;

class GetClientUseCase
{

    private GetRepository $repository;


    /**
     * @param \App\Client\Infrastructure\Repository\GetRepository $repository
     */
    public function __construct(GetRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return \App\Client\Infrastructure\Client
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $id): Client
    {
        return $this->repository->get($id);
    }

}
