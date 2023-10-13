<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Providers;

use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Shared\Observers\ModelEntityObserver;
use App\Providers\EventServiceProvider;

class ProjectEventServiceProvider extends EventServiceProvider
{
    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        ProjectModel::class => [
            ModelEntityObserver::class
        ]
    ];
}
