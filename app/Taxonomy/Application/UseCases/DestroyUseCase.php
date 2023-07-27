<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\UseCases;

use App\Taxonomy\Infrastructure\Category;
use App\Taxonomy\Infrastructure\Repositories\DeleteRepository;

final readonly class DestroyUseCase
{

    protected DeleteRepository $repository;


    /**
     * @param \App\Taxonomy\Infrastructure\Repositories\DeleteRepository $repository
     */
    public function __construct(DeleteRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Infrastructure\Category $category
     *
     * @return void
     */
    public function delete(Category $category): void
    {
        $this->repository->delete($category);
    }

}
