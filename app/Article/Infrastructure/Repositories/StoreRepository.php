<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\StoreContract;
use App\Article\Infrastructure\Article;
use App\Article\Interface\Requests\Http\CreateRequest;

final class StoreRepository implements StoreContract
{

    /**
     *
     * @param \App\Article\Interface\Requests\Http\CreateRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function save(CreateRequest $data): Article
    {
        $article = Article::create([
            'title' => $data->title,
            'summary' => $data->summary,
            'body' => $data->body,
            'category_id' => $data->category,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'user_id' => $data->user_id
        ]);

        return Article::findOrFail($article->id);
    }

}
