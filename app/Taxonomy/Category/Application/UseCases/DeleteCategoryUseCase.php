<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\UseCases;

use App\Taxonomy\Category\Infrastructure\CategoryRepository;

final class DeleteCategoryUseCase
{

    protected CategoryRepository $repository;


    /**
     * @param \App\Taxonomy\Category\Infrastructure\CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(string $id): void
    {
        $this->repository->delete($id);
    }

}
