<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Providers;

use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\Project\Domain\Policies\ProjectPolicy;
use App\Providers\AuthServiceProvider;

class ProjectAuthServiceProvider extends AuthServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ProjectModel::class => ProjectPolicy::class
    ];
}
