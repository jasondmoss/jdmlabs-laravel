<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Providers;

use App\Taxonomy\Category\Application\UseCases;
use App\Taxonomy\Category\Domain\Contracts;
use App\Taxonomy\Category\Infrastructure\Repositories;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(\App\Taxonomy\Application\UseCases\DestroyUseCase::class)
            ->needs(\App\Taxonomy\Domain\Contracts\DeleteContract::class)
            ->give(\App\Taxonomy\Application\Repositories\Eloquent\DeleteRepository::class);

        $this->app->when(\App\Taxonomy\Application\UseCases\StoreUseCase::class)
            ->needs(\App\Taxonomy\Domain\Contracts\StoreContract::class)
            ->give(\App\Taxonomy\Application\Repositories\Eloquent\StoreRepository::class);

        $this->app->when(\App\Taxonomy\Application\UseCases\UpdateUseCase::class)
            ->needs(\App\Taxonomy\Domain\Contracts\StoreContract::class)
            ->give(\App\Taxonomy\Application\Repositories\Eloquent\StoreRepository::class);


        // Tell Laravel of our custom templates path.
        View::addNamespace('CategoryEloquentModel', resource_path('views/ae/taxonomy/category'));
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
