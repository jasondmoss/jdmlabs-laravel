<?php

declare(strict_types=1);

namespace App\Taxonomy;

use App\Taxonomy\Category\Application\UseCases;
use App\Taxonomy\Category\Domain\Contract;
use App\Taxonomy\Category\Infrastructure\Repository;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TaxonomyServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCases\DeleteCategoryUseCase::class)
            ->needs(Contract\DeleteContract::class)
            ->give(Repository\DeleteRepository::class);

        $this->app->when(UseCases\GetCategoryUseCase::class)
            ->needs(Contract\GetContract::class)
            ->give(Repository\GetRepository::class);

        $this->app->when(UseCases\SaveCategoryUseCase::class)
            ->needs(Contract\SaveContract::class)
            ->give(Repository\SaveRepository::class);


        // Tell Laravel of our custom templates path.
        View::addNamespace('Category', resource_path('views/ae/taxonomy/category'));
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
