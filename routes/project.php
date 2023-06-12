<?php

declare(strict_types=1);

use App\Project\Application\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    // Public.
    Route::get('/projects', Controllers\PublishedController::class);
    Route::get('/project/{slug}', Controllers\SingleController::class);

    // Admin.
    Route::prefix('ae')->name('admin.')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {
        Route::get('/projects', Controllers\IndexController::class);
        Route::get('/project/create', Controllers\CreateController::class);
        Route::post('/project/create', Controllers\StoreController::class);
        Route::get('/project/edit/{id}', Controllers\EditController::class);
        Route::put('/project/update/{id}', Controllers\UpdateController::class);
        Route::delete('/project/{id}', Controllers\DestroyController::class);
    });

});
