<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\UpdateContract;
use App\Article\Infrastructure\Article;

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
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function update(object $data): Article
    {
        $instance = $this->article->find($data->id);

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
