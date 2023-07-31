<?php

declare(strict_types=1);

namespace App\Article\Domain\Observers;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use Illuminate\Support\Facades\App;

final readonly class ArticleObserver
{

    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function creating(ArticleEloquentModel $article): void
    {
        if (! App::runningInConsole()) {
            $article->user_id = auth()->user()->id;
        }
    }


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function created(ArticleEloquentModel $article): void {}


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function deleting(ArticleEloquentModel $article): void {}


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function deleted(ArticleEloquentModel $article): void {}


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function updating(ArticleEloquentModel $article): void {}


    /**
     * @param \App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel $article
     *
     * @return void
     */
    public function updated(ArticleEloquentModel $article): void {}

}
