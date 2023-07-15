<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Repositories;

use App\Article\Domain\Contracts\DestroyContract;
use App\Article\Infrastructure\Article;
use App\Shared\ValueObjects\Id;

final class DestroyRepository implements DestroyContract
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
     * @param string $id
     *
     * @return void
     * @throws \App\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function delete(string $id): void
    {
        $instance = $this->article->find((new Id($id))->value());

        $instance->delete();
    }

}
