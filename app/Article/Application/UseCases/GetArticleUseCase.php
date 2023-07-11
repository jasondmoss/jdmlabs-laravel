<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\Article;
use App\Article\Infrastructure\Repository\GetRepository;

final class GetArticleUseCase
{

    private GetRepository $repository;


    /**
     * @param \App\Article\Infrastructure\Repository\GetRepository $repository
     */
    public function __construct(GetRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param string $key
     *
     * @return \App\Article\Infrastructure\Article
     * @throws \App\Shared\Application\Exceptions\CouldNotFindEntry
     */
    public function __invoke(string $key): Article
    {
        return $this->repository->get($key);
    }

}
