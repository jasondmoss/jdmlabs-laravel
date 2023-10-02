<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\Providers;

use Aenginus\Media\Application\Respositories\Eloquent as Repository;
use Aenginus\Media\Application\UseCases as UseCase;
use Aenginus\Media\Domain\Contracts as Contract;
use Aenginus\Shared\Providers\SharedServiceProvider;

class MediaServiceProvider extends SharedServiceProvider
{

    /**
     * Register application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCase\StoreSingleImageUseCase::class)
            ->needs(Contract\StoreSingleImageContract::class)
            ->give(Repository\StoreSingleImageRepository::class);

        parent::register();
    }

}
