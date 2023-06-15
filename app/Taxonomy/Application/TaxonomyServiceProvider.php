<?php

declare(strict_types=1);

namespace App\Taxonomy\Application;

use App\Taxonomy\Application\UseCases;
use App\Taxonomy\Domain\TaxonomyRepositoryContract;
use Illuminate\Support\Facades\Route;
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
        View::addNamespace('Term', resource_path('views/ae/taxonomy/term'));
        View::addNamespace('Vocabulary', resource_path('views/ae/taxonomy/vocabulary'));
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Tell Laravel of our custom HTTP routes path.
        Route::middleware('web')->group(base_path('routes/taxonomy.php'));
    }

}
