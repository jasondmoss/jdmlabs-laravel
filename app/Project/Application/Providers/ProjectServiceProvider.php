<?php

declare(strict_types=1);

namespace App\Project\Application\Providers;

use App\Project\Application\UseCases;
use App\Project\Domain\Contracts;
use App\Project\Infrastructure\Repositories;
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
        $this->app->when(UseCases\DestroyUseCase::class)
            ->needs(Contracts\DestroyContract::class)
            ->give(Repositories\DestroyRepository::class);

        $this->app->when(UseCases\StoreUseCase::class)
            ->needs(Contracts\StoreContract::class)
            ->give(Repositories\StoreRepository::class);

        $this->app->when(UseCases\UpdateUseCase::class)
            ->needs(Contracts\UpdateContract::class)
            ->give(Repositories\UpdateRepository::class);


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