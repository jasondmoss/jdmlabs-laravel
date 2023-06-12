<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\ArticleRepository;

final class DeleteArticleUseCase {

    protected ArticleRepository $repository;


    /**
     * @param \App\Article\Infrastructure\ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $id): void
    {
        $this->repository->delete($id);
    }

}
