<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\UseCases;

use App\Taxonomy\Category\Infrastructure\Repositories\DeleteRepository;
use App\Taxonomy\Category\Infrastructure\Category;

final readonly class DestroyUseCase
{

    protected DeleteRepository $repository;


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Repositories\DeleteRepository $repository
     */
    public function __construct(DeleteRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Category $category
     *
     * @return void
     */
    public function delete(Category $category): void
    {
        $this->repository->delete($category);
    }

}
