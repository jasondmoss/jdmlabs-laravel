<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\UpdateContract;
use App\Article\Infrastructure\Article;
use App\Article\Interface\Requests\Http\UpdateRequest;

final class UpdateRepository implements UpdateContract
{

    protected Article $article;


    /**
     * @param \App\Article\Infrastructure\Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }


    /**
     * @inheritDoc
     */
    public function update(UpdateRequest $data): Article
    {
        $instance = $this->article->find($data->input('id'));

        $instance->update([
            'title' => $data->title,
            'summary' => $data->summary,
            'body' => $data->body,
            'category_id' => $data->category,
            'status' => $data->status,
            'promoted' => $data->promoted,
            'user_id' => $data->user_id
        ]);

        return Article::findOrFail($instance->id);
    }

}
