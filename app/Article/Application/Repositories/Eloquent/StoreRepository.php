<?php

declare(strict_types=1);

namespace App\Article\Application\Repositories\Eloquent;

use App\Article\Domain\Contracts\StoreContract;
use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(object $data): ArticleEloquentModel
    {
        $article = ArticleEloquentModel::create([
            'title' => $data->title,
            'summary' => $data->summary,
            'body' => $data->body,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'category_id' => $data->category,
            'user_id' => $data->user_id
        ]);

        return ArticleEloquentModel::findOrFail($article->id);
    }

}
