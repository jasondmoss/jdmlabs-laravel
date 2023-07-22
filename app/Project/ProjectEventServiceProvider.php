<?php

declare(strict_types=1);

namespace App\Project;

use App\Laravel\Application\Providers\EventServiceProvider;
use App\Project\Domain\ProjectObserver;
use App\Project\Infrastructure\Project;

class ProjectEventServiceProvider extends EventServiceProvider
{

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Project::class => [
            ProjectObserver::class
        ]
    ];

}
