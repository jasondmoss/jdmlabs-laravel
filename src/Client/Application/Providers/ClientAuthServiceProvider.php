<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Providers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Shared\Policies\ModelEntityPolicy;
use App\Providers\AuthServiceProvider;

class ClientAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ClientEloquentModel::class => ModelEntityPolicy::class
    ];

}
