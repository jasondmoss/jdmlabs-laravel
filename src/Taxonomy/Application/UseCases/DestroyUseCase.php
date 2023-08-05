<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\UseCases;

use Aenginus\Taxonomy\Application\Repositories\Eloquent\DeleteRepository;
use Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

final readonly class DestroyUseCase
{

    private DeleteRepository $repository;


    /**
     * @param \Aenginus\Taxonomy\Application\Repositories\Eloquent\DeleteRepository $repository
     */
    public function __construct(DeleteRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel $category
     *
     * @return void
     */
    public function delete(CategoryEloquentModel $category): void
    {
        $this->repository->delete($category);
    }

}
