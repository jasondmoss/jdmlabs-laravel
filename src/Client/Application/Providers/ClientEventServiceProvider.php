<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Providers;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Shared\Observers\ModelEntityObserver;
use App\Providers\EventServiceProvider;

class ClientEventServiceProvider extends EventServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $observers = [
        ClientModel::class => [
            ModelEntityObserver::class
        ]
    ];
}
