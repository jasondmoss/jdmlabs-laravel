<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\Repositories\StoreRepository;
use App\Article\Interface\Http\CreateRequest;

final readonly class StoreUseCase
{

    protected StoreRepository $repository;


    /**
     * @param \App\Article\Infrastructure\Repositories\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Article\Interface\Http\CreateRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function store(CreateRequest $data): Article
    {
        return $this->repository->save($data);
    }

}
