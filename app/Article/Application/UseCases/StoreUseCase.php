<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Application\Repositories\Eloquent\StoreRepository;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

final readonly class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Article\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param object $data
     *
     * @return \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel
     */
    public function store(object $data): ArticleEloquentModel
    {
        return $this->repository->save($data);
    }

}
