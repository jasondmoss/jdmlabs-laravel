<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Providers;

use Aenginus\Article\Application\Repositories\Eloquent as Repository;
use Aenginus\Article\Application\UseCases as UseCase;
use Aenginus\Article\Domain\Contracts as Contract;
use Aenginus\Shared\Providers\SharedServiceProvider;
use Illuminate\Support\Facades\View;

final class ArticleServiceProvider extends SharedServiceProvider
{

    /**
     * Register application services.
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
        View::addNamespace('ArticleAdmin', resource_path('views/aenginus/article'));
        View::addNamespace('ArticlePublic', resource_path('views/public/article'));

        parent::register();
    }

}
