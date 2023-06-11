<?php

declare(strict_types=1);

namespace App\Shared\Application;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;

class GlobalServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void {}


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void {
        Date::use(CarbonImmutable::class);
    }

}
