<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\Repository\SaveRepository;
use App\Article\Interface\ArticleFormRequest;

final class SaveArticleUseCase
{

    protected SaveRepository $repository;


    /**
     * @param \App\Article\Infrastructure\Repository\SaveRepository $repository
     */
    public function __construct(SaveRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Article\Interface\ArticleFormRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(ArticleFormRequest $data): Article
    {
        return $this->repository->save($data);
    }

}
