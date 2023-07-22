<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Domain\ClientObserver;
use App\Client\Infrastructure\Client;
use App\Laravel\Application\Providers\EventServiceProvider;

class ClientEventServiceProvider extends EventServiceProvider
{

    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $observers = [
        Client::class => [
            ClientObserver::class
        ]
    ];

}
