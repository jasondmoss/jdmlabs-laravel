<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Domain\ArticleRepositoryContract;
use App\Article\Infrastructure\ArticleModel;

final class GetArticleUseCase
{

    private ArticleRepositoryContract $repository;


    /**
     * @param \App\Article\Domain\ArticleRepositoryContract $repository
     */
    public function __construct(ArticleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $key
     *
     * @return \App\Article\Infrastructure\ArticleModel
     */
    public function __invoke(string $key): ArticleModel
    {
        return $this->repository->get($key);
    }

}
