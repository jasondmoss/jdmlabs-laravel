<?php

declare(strict_types=1);

namespace App\Article;

use App\Article\Domain\ArticleObserver;
use App\Article\Infrastructure\Article;
use App\Laravel\Application\Providers\EventServiceProvider;

class ArticleEventServiceProvider extends EventServiceProvider
{

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Article::class => [ ArticleObserver::class ]
    ];

}
