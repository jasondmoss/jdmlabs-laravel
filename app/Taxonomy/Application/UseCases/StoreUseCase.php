<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\UseCases;

use App\Taxonomy\Infrastructure\Category;
use App\Taxonomy\Infrastructure\Repositories\StoreRepository;
use App\Taxonomy\Interface\Http\CategoryRequest;

final class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Taxonomy\Infrastructure\Repositories\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Taxonomy\Interface\Http\CategoryRequest $data
     *
     * @return \App\Taxonomy\Infrastructure\Category
     */
    public function store(CategoryRequest $data): Category
    {
        return $this->repository->save($data);
    }

}
