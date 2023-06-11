<?php

declare(strict_types=1);

namespace App\Article\Application\UseCases;

use App\Article\Infrastructure\ArticleRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class GetRelatedArticlesUseCase {

    private ArticleRepository $repository;


    public function __construct()
    {
        $this->repository = new ArticleRepository;
    }


    /**
     * @param mixed $data
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(mixed $data): Model|Collection|Builder
    {
        return $this->repository->getRelatedArticles($data);
    }

}
