<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\UseCases;

use App\Taxonomy\Category\Infrastructure\Category;
use App\Taxonomy\Category\Infrastructure\Repository\GetRepository;

final class GetCategoryUseCase
{

    private GetRepository $repository;


    /**
     * @param \App\Taxonomy\Category\Infrastructure\Repository\GetRepository $repository
     */
    public function __construct(GetRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $key
     *
     * @return \App\Taxonomy\Category\Infrastructure\Category
     * @throws \App\Shared\Application\Exceptions\CouldNotFindCategory
     */
    public function __invoke(string $key): Category
    {
        return $this->repository->get($key);
    }

}
