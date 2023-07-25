<?php

declare(strict_types=1);

namespace App\Article\Application\Providers;

use App\Article\Application\UseCases;
use App\Article\Domain\Contracts;
use App\Article\Infrastructure\Repositories;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ArticleServiceProvider extends ServiceProvider
{

    /**
     * Register application services.
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


        // Tell Laravel of our custom templates paths.
        View::addNamespace('ArticleAdmin', resource_path('views/ae/article'));
        View::addNamespace('ArticlePublic', resource_path('views/public/article'));
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Configure Laravel to use CarbonImmutable for dates.
        Date::use(CarbonImmutable::class);
    }

}
