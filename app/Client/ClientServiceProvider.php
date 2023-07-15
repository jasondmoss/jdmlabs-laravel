<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Application\UseCases;
use App\Client\Domain\Contract;
use App\Client\Infrastructure\Repository;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCases\DeleteClientUseCase::class)
            ->needs(Contract\DeleteContract::class)
            ->give(Repository\DeleteRepository::class);

        $this->app->when(UseCases\GetClientProjectsUseCase::class)
            ->needs(Contract\GetClientProjectsContract::class)
            ->give(Repository\GetClientProjectsRepository::class);

        $this->app->when(UseCases\GetClientUseCase::class)
            ->needs(Contract\GetContract::class)
            ->give(Repository\GetRepository::class);

        $this->app->when(UseCases\GetPinnedClientsUseCase::class)
            ->needs(Contract\GetPinnedContract::class)
            ->give(Repository\GetPinnedRepository::class);

        $this->app->when(UseCases\GetPromotedClientsUseCase::class)
            ->needs(Contract\GetPromotedContract::class)
            ->give(Repository\GetPromotedRepository::class);

        $this->app->when(UseCases\GetPublishedClientsUseCase::class)
            ->needs(Contract\GetPublishedContract::class)
            ->give(Repository\GetPublishedRepository::class);

        $this->app->when(UseCases\SaveClientUseCase::class)
            ->needs(Contract\SaveContract::class)
            ->give(Repository\SaveRepository::class);


        // Tell Laravel of our custom templates path.
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
