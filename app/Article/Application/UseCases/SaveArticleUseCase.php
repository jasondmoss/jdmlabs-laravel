<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\ArticleRepository;
use App\Shared\Interface\EntryFormRequest;

final class SaveArticleUseCase {

    protected ArticleRepository $repository;


    /**
     * @param \App\Article\Infrastructure\ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(EntryFormRequest $data): Article
    {
        return $this->repository->save($data);
    }

}