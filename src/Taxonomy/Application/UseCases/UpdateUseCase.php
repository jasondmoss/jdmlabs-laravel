<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\UseCases;

use Aenginus\Taxonomy\Application\Repositories\Eloquent\UpdateRepository;
use Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity;

final readonly class UpdateUseCase
{

    private UpdateRepository $repository;


    /**
     * @param \Aenginus\Taxonomy\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     * @param \Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel
     */
    public function update(CategoryEloquentModel $category, CategoryEntity $entity): CategoryEloquentModel
    {
        return $this->repository->update($category, $entity);
    }

}
