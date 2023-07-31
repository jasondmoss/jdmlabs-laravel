<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Providers;

use App\Core\Laravel\Application\Providers\EventServiceProvider;
use App\Taxonomy\Domain\Observers\CategoryObserver;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

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
