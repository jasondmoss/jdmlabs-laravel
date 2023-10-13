<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\UseCases;

use Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Aenginus\Taxonomy\Application\Repositories\Eloquent\DeleteRepository;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Exception;

final readonly class DestroyUseCase
{
    private CategoryModel $category;

    private DeleteRepository $repository;


    /**
     * @param \Aenginus\Taxonomy\Domain\Models\CategoryModel $category
     * @param \Aenginus\Taxonomy\Application\Repositories\Eloquent\DeleteRepository $repository
     */
    public function __construct(CategoryModel $category, DeleteRepository $repository)
    {
        $this->category = $category;
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function delete(string $id): void
    {
        $toBeDeleted = $this->category->find((new UlidValueObject($id))->value());

        try {
            $this->repository->delete($toBeDeleted);
        } catch (Exception) {
            throw CouldNotDeleteModelEntity::withId($toBeDeleted->id);
        }
    }
}
