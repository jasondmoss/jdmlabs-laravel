<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Providers;

use Aenginus\Project\Infrastructure\EloquentModels\ProjectEloquentModel;
use Aenginus\Shared\Policies\ModelEntityPolicy;
use App\Providers\AuthServiceProvider;

class ProjectAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ProjectEloquentModel::class => ModelEntityPolicy::class
    ];

}
