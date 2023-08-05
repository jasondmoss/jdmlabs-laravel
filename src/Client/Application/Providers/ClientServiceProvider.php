<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Providers;

use Aenginus\Client\Application\Repositories\Eloquent as Repository;
use Aenginus\Client\Application\UseCases as UseCase;
use Aenginus\Client\Domain\Contracts as Contract;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class ClientServiceProvider extends ServiceProvider
{

    /**
     * Register application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCase\DestroyUseCase::class)
            ->needs(Contract\DestroyContract::class)
            ->give(Repository\DestroyRepository::class);

        $this->app->when(UseCase\StoreUseCase::class)
            ->needs(Contract\StoreContract::class)
            ->give(Repository\StoreRepository::class);

        $this->app->when(UseCase\UpdateUseCase::class)
            ->needs(Contract\UpdateContract::class)
            ->give(Repository\UpdateRepository::class);

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
