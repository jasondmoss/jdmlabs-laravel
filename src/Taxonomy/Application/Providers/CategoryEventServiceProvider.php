<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Providers;

use Aenginus\Taxonomy\Domain\Observers\CategoryObserver;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use App\Providers\EventServiceProvider;

class CategoryEventServiceProvider extends EventServiceProvider
{

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        CategoryEloquentModel::class => [ CategoryObserver::class ]
    ];

}
