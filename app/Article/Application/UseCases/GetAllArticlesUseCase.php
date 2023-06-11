<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\ArticleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as CollectionSupport;

final class GetAllArticlesUseCase {

    private ArticleRepository $repository;


    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param bool $pluck
     * @param string|null $column
     * @param mixed|null $key
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke(
        bool $pluck = false,
        string $column = null,
        mixed $key = null
    ): Collection|CollectionSupport
    {
        return $this->repository->getAllArticles($pluck, $column, $key);
    }

}
