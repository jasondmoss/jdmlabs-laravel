<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\StoreContract;
use App\Article\Infrastructure\Article;
use App\Article\Interface\Requests\Http\CreateRequest;

final class StoreRepository implements StoreContract
{

    /**
     * @inheritDoc
     */
    public function save(CreateRequest $data): Article
    {
        $article = Article::create([
            'title' => $data->title,
            'summary' => $data->summary,
            'body' => $data->body,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'category_id' => $data->category,
            'user_id' => $data->user_id
        ]);

        return Article::findOrFail($article->id);
    }

}
