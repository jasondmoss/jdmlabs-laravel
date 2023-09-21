<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\UseCases;

use Aenginus\Taxonomy\Application\Repositories\Eloquent\UpdateRepository;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
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
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     * @param \Aenginus\Taxonomy\Infrastructure\Entities\CategoryEntity $entity
     *
     * @return \Aenginus\Taxonomy\Domain\Models\CategoryModel
     */
    public function update(CategoryModel $category, CategoryEntity $entity): CategoryModel
    {
        return $this->repository->update($category, $entity);
    }

}
