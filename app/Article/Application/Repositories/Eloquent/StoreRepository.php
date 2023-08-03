<?php

declare(strict_types=1);

namespace App\Article\Application\Repositories\Eloquent;

use App\Article\Domain\Contracts\StoreContract;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Article\Infrastructure\Entities\ArticleEntity;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(ArticleEntity $entity): ArticleEloquentModel
    {
        return ArticleEloquentModel::create([
            'title' => $entity->title,
            'summary' => $entity->summary,
            'body' => $entity->body,
            'status' => $entity->status,
            'promoted' => $entity->promoted,
            'category_id' => $entity->category,
            'user_id' => $entity->user_id
        ]);
    }

}
