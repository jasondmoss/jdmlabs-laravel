<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\UseCases;

use App\Taxonomy\Category\Infrastructure\Repository\DeleteRepository;

final class DeleteCategoryUseCase
{

    protected DeleteRepository $repository;


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Repository\DeleteRepository $repository
     */
    public function __construct(DeleteRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Shared\Application\Exceptions\CouldNotFindCategory
     */
    public function __invoke(string $id): void
    {
        $this->repository->delete($id);
    }

}
