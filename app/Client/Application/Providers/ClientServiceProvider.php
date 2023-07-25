<?php

declare(strict_types=1);

namespace App\Client\Application\Providers;

use App\Client\Application\UseCases;
use App\Client\Domain\Contracts;
use App\Client\Infrastructure\Repositories;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
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
        View::addNamespace('ClientAdmin', resource_path('views/ae/client'));
        View::addNamespace('ClientPublic', resource_path('views/public/client'));
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
