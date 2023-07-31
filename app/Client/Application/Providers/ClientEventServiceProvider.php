<?php

declare(strict_types=1);

namespace App\Client\Application\Providers;

use App\Client\Domain\Observers\ClientObserver;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Core\Laravel\Application\Providers\EventServiceProvider;

class ClientEventServiceProvider extends EventServiceProvider
{

    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $observers = [
        ClientEloquentModel::class => [
            ClientObserver::class
        ]
    ];

}
