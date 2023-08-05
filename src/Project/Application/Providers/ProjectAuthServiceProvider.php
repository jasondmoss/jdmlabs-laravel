<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Providers;

use Aenginus\Project\Domain\Policies\ProjectPolicy;
use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use App\Providers\AuthServiceProvider;

class ProjectAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ProjectEloquentModel::class => ProjectPolicy::class
    ];

}
