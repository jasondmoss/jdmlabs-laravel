<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Providers;

use App\Taxonomy\Application\Repositories\Eloquent;
use App\Taxonomy\Application\UseCases;
use App\Taxonomy\Domain\Contracts;
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
        $this->app->when(UseCases\DestroyUseCase::class)
            ->needs(Contracts\DeleteContract::class)
            ->give(Eloquent\DeleteRepository::class);

        $this->app->when(UseCases\StoreUseCase::class)
            ->needs(Contracts\StoreContract::class)
            ->give(Eloquent\StoreRepository::class);

        $this->app->when(UseCases\UpdateUseCase::class)
            ->needs(Contracts\StoreContract::class)
            ->give(Eloquent\StoreRepository::class);


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
