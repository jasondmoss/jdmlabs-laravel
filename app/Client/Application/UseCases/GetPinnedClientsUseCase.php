<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Domain\ClientRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPinnedClientsUseCase {

    private ClientRepositoryContract $repository;


    public function __construct(ClientRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->repository->getPinnedClients($column, $pages);
    }

}
