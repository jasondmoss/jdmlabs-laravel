<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\UseCases;

use App\Taxonomy\Infrastructure\Category;
use App\Taxonomy\Infrastructure\Repositories\UpdateRepository;
use App\Taxonomy\Interface\Http\CategoryRequest;

final readonly class UpdateUseCase
{

    protected UpdateRepository $repository;


    /**
     * @param \App\Taxonomy\Infrastructure\Repositories\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Interface\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Infrastructure\Category
     * @throws \App\Taxonomy\Application\Exceptions\CouldNotFindCategory
     */
    public function update(CategoryRequest $data): Category
    {
        return $this->repository->update($data);
    }

}
