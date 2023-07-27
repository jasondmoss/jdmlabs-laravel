<?php

declare(strict_types=1);

namespace App\Project\Application\Providers;

use App\Core\Laravel\Application\Providers\AuthServiceProvider;
use App\Project\Domain\ProjectPolicy;
use App\Project\Infrastructure\Project;

class ProjectAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class
    ];

}
