<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Providers;

use Aenginus\Shared\Providers\SharedServiceProvider;
use Aenginus\Taxonomy\Application\Repositories\Eloquent as Repository;
use Aenginus\Taxonomy\Application\UseCases as UseCase;
use Aenginus\Taxonomy\Domain\Contracts as Contract;
use Illuminate\Support\Facades\View;

final class CategoryServiceProvider extends SharedServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app
            ->when(UseCase\DestroyUseCase::class)
            ->needs(Contract\DeleteContract::class)
            ->give(Repository\DeleteRepository::class);

        $this->app
            ->when(UseCase\StoreUseCase::class)
            ->needs(Contract\StoreContract::class)
            ->give(Repository\StoreRepository::class);

        $this->app
            ->when(UseCase\UpdateUseCase::class)
            ->needs(Contract\StoreContract::class)
            ->give(Repository\StoreRepository::class);

        // Templates paths.
        View::addNamespace(
            'Category', resource_path('views/aenginus/taxonomy/category')
        );

        parent::register();
    }
}
