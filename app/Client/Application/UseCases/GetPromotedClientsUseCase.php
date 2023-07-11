<?php

declare(strict_types=1);

namespace App\Client\Application\UseCases;

use App\Client\Infrastructure\Repository\GetPromotedRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPromotedClientsUseCase
{

    private GetPromotedRepository $repository;


    /**
     * @param \App\Client\Infrastructure\Repository\GetPromotedRepository $repository
     */
    public function __construct(GetPromotedRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $column
     * @param int $pages
     *
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->repository->getPromoted($column, $pages);
    }

}
