<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Domain\ClientPolicy;
use App\Client\Infrastructure\Client;
use App\Laravel\Application\Providers\AuthServiceProvider;

class ClientAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        Client::class => ClientPolicy::class
    ];

}
