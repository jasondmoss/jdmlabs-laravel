<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\UseCases;

use Aenginus\Article\Application\Repositories\Eloquent\UpdateRepository;
use Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

final readonly class UpdateUseCase
{

    private UpdateRepository $repository;


    /**
     * @param \Aenginus\Article\Application\Repositories\Eloquent\UpdateRepository $repository
     */
    public function __construct(UpdateRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     * @param \Aenginus\Article\Infrastructure\Entities\ArticleEntity $entity
     *
     * @return \Aenginus\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel
     */
    public function update(
        ArticleEloquentModel $article,
        ArticleEntity $entity
    ): ArticleEloquentModel
    {
        return $this->repository->update($article, $entity);
    }

}
