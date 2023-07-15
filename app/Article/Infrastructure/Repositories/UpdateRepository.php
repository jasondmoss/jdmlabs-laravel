<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\UpdateContract;
use App\Article\Infrastructure\Article;
use App\Article\Interface\Requests\Http\UpdateRequest;

final class UpdateRepository implements UpdateContract
{

    /**
     *
     * @param \App\Article\Interface\Requests\Http\UpdateRequest $data
     *
     * @return \App\Article\Infrastructure\Article
     */
    public function save(UpdateRequest $data): Article
    {
        $article = Article::update([
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
