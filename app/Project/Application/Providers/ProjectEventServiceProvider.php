<?php

declare(strict_types=1);

namespace App\Project\Application\Providers;

use App\Core\Laravel\Application\Providers\EventServiceProvider;
use App\Project\Domain\Observers\ProjectObserver;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

class ProjectEventServiceProvider extends EventServiceProvider
{

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        ProjectEloquentModel::class => [
            ProjectObserver::class
        ]
    ];

}
