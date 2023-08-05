<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Providers;

use Aenginus\Client\Domain\Policies\ClientPolicy;
use Aenginus\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Providers\AuthServiceProvider;

class ClientAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ClientEloquentModel::class => ClientPolicy::class
    ];

}
