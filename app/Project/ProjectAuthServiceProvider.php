<?php

declare(strict_types=1);

namespace App\Project;

use App\Laravel\Application\Providers\AuthServiceProvider;
use App\Project\Domain\ProjectPolicy;
use App\Project\Infrastructure\Project;

class ProjectAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        Project::class => ProjectPolicy::class
    ];

}
