<?php

declare(strict_types=1);

namespace App\Article\Domain;

use App\Article\Infrastructure\Article;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

final readonly class ArticleObserver
{

    /**
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return void
     */
    public function creating(Article $article): void
    {
        if (! App::runningInConsole()) {
            $article->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return void
     */
    public function created(Article $article): void {}


    /**
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return void
     */
    public function deleting(Article $article): void {}


    /**
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return void
     */
    public function deleted(Article $article): void {}


    /**
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return void
     */
    public function updating(Article $article): void
    {
        $article->slug = Str::of($article->title)->slug('-');
    }


    /**
     * @param \App\Article\Infrastructure\Article $article
     *
     * @return void
     */
    public function updated(Article $article): void {}
}
