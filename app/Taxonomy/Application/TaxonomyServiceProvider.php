<?php

declare(strict_types=1);

namespace App\Taxonomy\Application;

use App\Taxonomy\Application\UseCases;
use App\Taxonomy\Domain\TaxonomyRepositoryContract;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TaxonomyServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCases\DeleteVocabularyUseCase::class)
            ->needs(TaxonomyRepositoryContract::class)
            ->give(TaxonomyRepositoryContract::class);

        $this->app->when(UseCases\GetVocabularyUseCase::class)
            ->needs(TaxonomyRepositoryContract::class)
            ->give(TaxonomyRepositoryContract::class);

        $this->app->when(UseCases\SaveVocabularyUseCase::class)
            ->needs(TaxonomyRepositoryContract::class)
            ->give(TaxonomyRepositoryContract::class);


        // Tell Laravel of our custom templates path.
        View::addNamespace('Vocabulary', resource_path('views/ae/taxonomy'));
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
