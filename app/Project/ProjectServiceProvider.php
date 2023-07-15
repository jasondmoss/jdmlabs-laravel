<?php

declare(strict_types=1);

namespace App\Project;

use App\Project\Application\UseCases;
use App\Project\Domain\Contract;
use App\Project\Infrastructure\Repository;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ProjectServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCases\DeleteProjectUseCase::class)
            ->needs(Contract\DeleteContract::class)
            ->give(Repository\DeleteRepository::class);

        $this->app->when(UseCases\GetPinnedProjectsUseCase::class)
            ->needs(Contract\GetPinnedContract::class)
            ->give(Repository\GetPinnedRepository::class);

        $this->app->when(UseCases\GetProjectUseCase::class)
            ->needs(Contract\GetContract::class)
            ->give(Repository\GetRepository::class);

        $this->app->when(UseCases\GetPromotedProjectsUseCase::class)
            ->needs(Contract\GetPromotedContract::class)
            ->give(Repository\GetPromotedRepository::class);

        $this->app->when(UseCases\GetPublishedProjectsUseCase::class)
            ->needs(Contract\GetPublishedContract::class)
            ->give(Repository\GetPublishedRepository::class);

        $this->app->when(UseCases\GetRelatedProjectsUseCase::class)
            ->needs(Contract\GetRelatedContract::class)
            ->give(Repository\GetRelatedRepository::class);

        $this->app->when(UseCases\SaveProjectUseCase::class)
            ->needs(Contract\SaveContract::class)
            ->give(Repository\SaveRepository::class);


        // Tell Laravel of our custom templates path.
        View::addNamespace('ProjectAdmin', resource_path('views/ae/project'));
        View::addNamespace('ProjectPublic', resource_path('views/public/project'));
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Date::use(CarbonImmutable::class);
    }

}
