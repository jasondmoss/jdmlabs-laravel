<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Domain\ClientObserver;
use App\Client\Infrastructure\Client;
use App\Laravel\Application\Providers\EventServiceProvider;

class ClientEventServiceProvider extends EventServiceProvider
{

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Client::class => [ ClientObserver::class ]
    ];

}
