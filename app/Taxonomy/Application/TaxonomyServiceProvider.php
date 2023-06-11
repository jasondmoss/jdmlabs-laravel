<?php

declare(strict_types=1);

namespace App\Taxonomy\Application;

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
        // Tell Laravel of our custom templates path.
        View::addNamespace('Taxonomy', resource_path('views/ae/taxonomy'));
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
