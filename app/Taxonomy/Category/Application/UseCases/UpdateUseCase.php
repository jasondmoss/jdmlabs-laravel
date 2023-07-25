<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\UseCases;

use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Infrastructure\Repositories\UpdateRepository;
use App\Taxonomy\Category\Interface\Http\CategoryRequest;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Repositories\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     * @throws \App\Taxonomy\Category\Application\Exceptions\CouldNotFindCategory
     */
    public function update(CategoryRequest $data): Category
    {
        return $this->repository->update($data);
    }

}
