<?php

declare(strict_types=1);

namespace App\Project;

use App\Project\Application\UseCases;
use App\Project\Domain\ProjectRepositoryContract;
use App\Project\Infrastructure\ProjectRepository;
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
            ->needs(ProjectRepositoryContract::class)
            ->give(ProjectRepository::class);

        $this->app->when(UseCases\GetAllProjectsUseCase::class)
            ->needs(ProjectRepositoryContract::class)
            ->give(ProjectRepository::class);

        $this->app->when(UseCases\GetPinnedProjectsUseCase::class)
            ->needs(ProjectRepositoryContract::class)
            ->give(ProjectRepository::class);

        $this->app->when(UseCases\GetProjectUseCase::class)
            ->needs(ProjectRepositoryContract::class)
            ->give(ProjectRepository::class);

        $this->app->when(UseCases\GetPromotedProjectsUseCase::class)
            ->needs(ProjectRepositoryContract::class)
            ->give(ProjectRepository::class);

        $this->app->when(UseCases\GetPublishedProjectsUseCase::class)
            ->needs(ProjectRepositoryContract::class)
            ->give(ProjectRepository::class);

        $this->app->when(UseCases\GetRelatedProjectsUseCase::class)
            ->needs(ProjectRepositoryContract::class)
            ->give(ProjectRepository::class);

        $this->app->when(UseCases\SaveProjectUseCase::class)
            ->needs(ProjectRepositoryContract::class)
            ->give(ProjectRepository::class);


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
        // Tell Laravel of our custom routes path.
        //        Route::middleware('web')->group(base_path('routes/project.php'));
    }

}
