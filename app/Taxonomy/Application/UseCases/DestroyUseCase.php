<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\UseCases;

use App\Taxonomy\Application\Repositories\Eloquent\DeleteRepository;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

final readonly class DestroyUseCase
{

    protected DeleteRepository $repository;


    /**
     * @param \App\Taxonomy\Application\Repositories\Eloquent\DeleteRepository $repository
     */
    public function __construct(DeleteRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function delete(CategoryEloquentModel $category): void
    {
        $this->repository->delete($category);
    }

}
