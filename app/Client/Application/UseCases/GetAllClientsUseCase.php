<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Domain\ClientRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionSupport;

class GetAllClientsUseCase {

    protected ClientRepositoryContract $repository;


    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(
        bool $pluck = false,
        string $column = null,
        mixed $key = null
    ): Collection|CollectionSupport
    {
        return $this->repository->getAllClients($pluck, $column, $key);
    }

}
