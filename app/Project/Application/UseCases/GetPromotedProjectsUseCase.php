<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Domain\ProjectRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPromotedProjectsUseCase {

    private ProjectRepositoryContract $repository;


    public function __construct(ProjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(string $column = 'id', int $pages = 10): Paginator|Builder
    {
        return $this->repository->getPromotedProjects($column, $pages);
    }

}
