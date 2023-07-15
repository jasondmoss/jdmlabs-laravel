<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\Repositories\StoreRepository;
use App\Article\Interface\Requests\Http\CreateRequest;

final class UpdateArticleUseCase
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
     * @param \App\Article\Interface\Requests\Http\CreateRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(CreateRequest $data): Article
    {
        return $this->repository->save($data);
    }

}
