<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Application\UseCases;
use App\Client\Domain\ClientRepositoryContract;
use App\Client\Infrastructure\ClientRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCases\DeleteClientUseCase::class)
            ->needs(ClientRepositoryContract::class)
            ->give(ClientRepository::class);

        $this->app->when(UseCases\GetAllClientsUseCase::class)
            ->needs(ClientRepositoryContract::class)
            ->give(ClientRepository::class);

        $this->app->when(UseCases\GetClientProjectsUseCase::class)
            ->needs(ClientRepositoryContract::class)
            ->give(ClientRepository::class);

        $this->app->when(UseCases\GetClientUseCase::class)
            ->needs(ClientRepositoryContract::class)
            ->give(ClientRepository::class);

        $this->app->when(UseCases\GetPinnedClientsUseCase::class)
            ->needs(ClientRepositoryContract::class)
            ->give(ClientRepository::class);

        $this->app->when(UseCases\GetPromotedClientsUseCase::class)
            ->needs(ClientRepositoryContract::class)
            ->give(ClientRepository::class);

        $this->app->when(UseCases\GetPublishedClientsUseCase::class)
            ->needs(ClientRepositoryContract::class)
            ->give(ClientRepository::class);

        $this->app->when(UseCases\SaveClientUseCase::class)
            ->needs(ClientRepositoryContract::class)
            ->give(ClientRepository::class);


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
        //
    }

}
