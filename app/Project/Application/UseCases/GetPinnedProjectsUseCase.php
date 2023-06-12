<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Domain\ProjectRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPinnedProjectsUseCase {

    private ProjectRepositoryContract $repository;


    /**
     * @param \App\Project\Domain\ProjectRepositoryContract $repository
     */
    public function __construct(ProjectRepositoryContract $repository)
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
