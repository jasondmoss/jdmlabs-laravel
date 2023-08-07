<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Providers;

use Aenginus\Client\Domain\Observers\ClientObserver;
use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use App\Providers\EventServiceProvider;

class ClientEventServiceProvider extends EventServiceProvider
{

    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $observers = [
        ClientEloquentModel::class => [
            ClientObserver::class
        ]
    ];

}
