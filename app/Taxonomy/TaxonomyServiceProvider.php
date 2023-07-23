<?php

declare(strict_types=1);

namespace App\Taxonomy;

use App\Taxonomy\Category\Application\UseCases;
use App\Taxonomy\Category\Domain\Contracts;
use App\Taxonomy\Category\Infrastructure\Repositories;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TaxonomyServiceProvider extends ServiceProvider
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
            ->give(Repositories\DeleteRepository::class);

        $this->app->when(UseCases\GetCategoryUseCase::class)
            ->needs(Contracts\GetContract::class)
            ->give(Repositories\GetRepository::class);

        $this->app->when(UseCases\StoreUseCase::class)
            ->needs(Contracts\StoreContract::class)
            ->give(Repositories\StoreRepository::class);


        // Tell Laravel of our custom templates path.
        View::addNamespace('Category', resource_path('views/ae/taxonomy/category'));
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
