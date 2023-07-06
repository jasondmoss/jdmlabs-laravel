<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\ArticleModel;
use App\Article\Infrastructure\ArticleRepository;
use App\Article\Interface\ArticleFormRequest;

final class SaveArticleUseCase
{

    protected ArticleRepository $repository;


    /**
     * @param \App\Article\Infrastructure\ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Article\Interface\ArticleFormRequest $data
     *
     * @return \App\Article\Infrastructure\ArticleModel
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(ArticleFormRequest $data): ArticleModel
    {
        return $this->repository->save($data);
    }

}
