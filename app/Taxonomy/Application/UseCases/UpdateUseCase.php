<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\UseCases;

use App\Taxonomy\Application\Repositories\Eloquent\UpdateRepository;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use App\Taxonomy\Infrastructure\Entities\CategoryEntity;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Taxonomy\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     * @param \App\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function update(CategoryEloquentModel $category, CategoryEntity $entity): CategoryEloquentModel
    {
        return $this->repository->update($category, $entity);
    }

}
