<?php

declare(strict_types=1);

use App\Taxonomy\Application\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    // Public.

    // Admin.
    Route::prefix('ae')->name('admin.')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {
        Route::get('/taxonomies', Controllers\ListController::class);
        // ...
    });

});
