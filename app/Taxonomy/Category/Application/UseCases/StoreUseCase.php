<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\UseCases;

use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Infrastructure\Repositories\StoreRepository;
use App\Taxonomy\Category\Interface\Http\CategoryRequest;

final class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Repositories\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Category\Interface\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     */
    public function store(CategoryRequest $data): Category
    {
        return $this->repository->save($data);
    }

}
