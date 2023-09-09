<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Providers;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Shared\Observers\ModelEntityObserver;
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
            ModelEntityObserver::class
        ]
    ];

}
