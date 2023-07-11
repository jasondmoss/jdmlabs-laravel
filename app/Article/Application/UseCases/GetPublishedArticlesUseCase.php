<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Repository\GetPublishedRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

final class GetPublishedArticlesUseCase
{

    private GetPublishedRepository $repository;


    /**
     * @param \App\Article\Infrastructure\Repository\GetPublishedRepository $repository
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
