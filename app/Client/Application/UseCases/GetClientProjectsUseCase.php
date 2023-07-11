<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Infrastructure\Repository\GetClientProjectsRepository;
use Illuminate\Database\Eloquent\Collection;

class GetClientProjectsUseCase
{

    private GetClientProjectsRepository $repository;


    /**
     * @param \App\Client\Infrastructure\Repository\GetClientProjectsRepository $repository
     */
    public function __construct(GetClientProjectsRepository $repository)
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
