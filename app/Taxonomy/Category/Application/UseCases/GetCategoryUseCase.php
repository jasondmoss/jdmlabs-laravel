<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\UseCases;

use App\Taxonomy\Category\Domain\CategoryRepositoryContract;
use App\Taxonomy\Category\Infrastructure\Category;

final class GetCategoryUseCase
{

    private CategoryRepositoryContract $repository;


    /**
     * @param \App\Taxonomy\Category\Domain\CategoryRepositoryContract $repository
     */
    public function __construct(CategoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $key
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function __invoke(string $key): Category
    {
        return $this->repository->get($key);
    }

}
