<?php

declare(strict_types=1);

namespace App\Project\Application\UseCases;

use App\Project\Infrastructure\Repository\GetPublishedRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

class GetPublishedProjectsUseCase
{

    private GetPublishedRepository $repository;


    /**
     * @param \App\Project\Infrastructure\Repository\GetPublishedRepository $repository
     */
    public function __construct(GetPublishedRepository $repository)
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
        return $this->repository->getPublished($column, $pages);
    }

}
