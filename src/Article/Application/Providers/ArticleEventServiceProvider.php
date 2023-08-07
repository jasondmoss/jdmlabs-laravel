<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Providers;

use Aenginus\Article\Domain\Observers\ArticleObserver;
use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use App\Providers\EventServiceProvider;

class ArticleEventServiceProvider extends EventServiceProvider
{

    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $observers = [
        ArticleEloquentModel::class => [
            ArticleObserver::class
        ]
    ];

}
