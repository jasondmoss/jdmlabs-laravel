<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Providers;

use Aenginus\Project\Domain\Observers\ProjectObserver;
use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Providers\EventServiceProvider;

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
