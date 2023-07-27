<?php

declare(strict_types=1);

namespace App\Article\Application\Providers;

use App\Article\Domain\ArticleObserver;
use App\Article\Infrastructure\Article;
use App\Core\Laravel\Application\Providers\EventServiceProvider;

class ArticleEventServiceProvider extends EventServiceProvider
{

    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $observers = [
        Article::class => [
            ArticleObserver::class
        ]
    ];

}
