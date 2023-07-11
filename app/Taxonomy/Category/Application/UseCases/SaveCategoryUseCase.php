<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\UseCases;

use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Infrastructure\Repository\SaveRepository;
use App\Taxonomy\Category\Interface\CategoryFormRequest;

final class SaveCategoryUseCase
{

    protected SaveRepository $repository;


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Repository\SaveRepository $repository
     */
    public function __construct(SaveRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\CategoryFormRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function __invoke(CategoryFormRequest $data): Category
    {
        return $this->repository->save($data);
    }

}
