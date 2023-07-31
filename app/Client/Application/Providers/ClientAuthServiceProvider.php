<?php

declare(strict_types=1);

namespace App\Client\Application\Providers;

use App\Client\Domain\Policies\ClientPolicy;
use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Core\Laravel\Application\Providers\AuthServiceProvider;

class ClientAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ClientEloquentModel::class => ClientPolicy::class
    ];

}
