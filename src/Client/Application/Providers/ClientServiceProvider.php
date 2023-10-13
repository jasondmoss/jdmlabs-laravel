<?php

declare(strict_types=1);

namespace Aenginus\Client\Application\Providers;

use Aenginus\Client\Application\Repositories\Eloquent as Repository;
use Aenginus\Client\Application\UseCases as UseCase;
use Aenginus\Client\Domain\Contracts as Contract;
use Aenginus\Shared\Providers\SharedServiceProvider;
use Illuminate\Support\Facades\View;

final class ClientServiceProvider extends SharedServiceProvider
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

        // Templates paths.
        View::addNamespace('ClientAdmin', resource_path('views/aenginus/client'));
        View::addNamespace('ClientPublic', resource_path('views/public/client'));

        parent::register();
    }
}
