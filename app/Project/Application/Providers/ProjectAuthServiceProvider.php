<?php

declare(strict_types=1);

namespace App\Project\Application\Providers;

use App\Core\Laravel\Application\Providers\AuthServiceProvider;
use App\Project\Domain\Policies\ProjectPolicy;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;

class ProjectAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ProjectEloquentModel::class => ProjectPolicy::class
    ];

}
