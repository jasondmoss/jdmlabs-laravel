<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\UseCases;

use Aenginus\Article\Application\Repositories\Eloquent\StoreRepository;
use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Article\Infrastructure\Entities\ArticleEntity;

final readonly class StoreUseCase
{

    private StoreRepository $repository;


    /**
     * @param \Aenginus\Article\Application\Repositories\Eloquent\StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Aenginus\Article\Infrastructure\Entities\ArticleEntity $entity
     *
     * @return \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel
     */
    public function store(ArticleEntity $entity): ArticleEloquentModel
    {
        return $this->repository->save($entity);
    }

}
