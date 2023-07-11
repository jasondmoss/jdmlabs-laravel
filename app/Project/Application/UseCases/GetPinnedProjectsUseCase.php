<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\Repository\GetPinnedRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPinnedProjectsUseCase
{

    private GetPinnedRepository $repository;


    /**
     * @param \App\Project\Infrastructure\Repository\GetPinnedRepository $repository
     */
    public function __construct(GetPinnedRepository $repository)
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
        return $this->repository->getPinned($column, $pages);
    }

}
