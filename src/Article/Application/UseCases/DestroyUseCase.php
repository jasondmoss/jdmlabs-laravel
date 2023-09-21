<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\UseCases;

use Aenginus\Article\Application\Repositories\Eloquent\DestroyRepository;
use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Exception;

final readonly class DestroyUseCase
{

    protected ArticleModel $article;
    private DestroyRepository $repository;


    /**
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     * @param \Aenginus\Article\Application\Repositories\Eloquent\DestroyRepository $repository
     */
    public function __construct(ArticleModel $article, DestroyRepository $repository)
    {
        $this->article = $article;
        $this->repository = $repository;
    }


    /**
     * @param string $id
     *
     * @return void
     * @throws \Aenginus\Shared\Exceptions\CouldNotDeleteModelEntity
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function delete(string $id): void
    {
        $toBeDeleted = $this->article->find((new UlidValueObject($id))->value());

        try {
            $this->repository->delete($toBeDeleted);
        } catch (Exception) {
            throw CouldNotDeleteModelEntity::withId($toBeDeleted->id);
        }
    }

}
