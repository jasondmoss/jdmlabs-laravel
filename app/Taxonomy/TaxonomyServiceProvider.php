<?php

declare(strict_types=1);

namespace App\Taxonomy;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TaxonomyServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void {

        // Tell Laravel of our custom templates path.
        View::addNamespace('TaxonomyAdmin', resource_path('views/ae/taxonomy'));
        View::addNamespace('TaxonomyPublic', resource_path('views/public/taxonomy'));
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Tell Laravel of our custom routes path.
//        Route::middleware('web')->group(base_path('routes/taxonomy.php'));
    }

}
