<?php

declare(strict_types=1);

namespace Aenginus\Project\Application\Providers;

use Aenginus\Project\Application\Repositories\Eloquent as Repository;
use Aenginus\Project\Application\UseCases as UseCase;
use Aenginus\Project\Domain\Contracts as Contract;
use Aenginus\Shared\Providers\SharedServiceProvider;
use Illuminate\Support\Facades\View;

final class ProjectServiceProvider extends SharedServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCase\DestroyUseCase::class)->needs(Contract\DestroyContract::class)->give(
                Repository\DestroyRepository::class
            );

        $this->app->when(UseCase\StoreUseCase::class)->needs(Contract\StoreContract::class)->give(
                Repository\StoreRepository::class
            );

        $this->app->when(UseCase\UpdateUseCase::class)->needs(Contract\UpdateContract::class)->give(
                Repository\UpdateRepository::class
            );

        // Templates paths.
        View::addNamespace('ProjectAdmin', resource_path('views/aenginus/project'));
        View::addNamespace('ProjectPublic', resource_path('views/public/project'));

        parent::register();
    }

}
