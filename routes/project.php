<?php

declare(strict_types=1);

use App\Project\Application\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    // Public.
    Route::get('/projects', Controllers\ProjectPublicPublishedController::class);
    Route::get('/project/{slug}', Controllers\ProjectPublicShowController::class);

    // Admin.
    Route::prefix('ae')->name('admin.')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {
        Route::get('/projects', Controllers\ProjectAdminListController::class);
        Route::get('/project/create', Controllers\ProjectAdminCreateController::class);
        Route::post('/project/create', Controllers\ProjectAdminStoreController::class);
        Route::get('/project/edit/{id}', Controllers\ProjectAdminEditController::class);
        Route::put('/project/update/{id}', Controllers\ProjectAdminUpdateController::class);
        Route::delete('/project/{id}', Controllers\ProjectAdminDestroyController::class);
    });

});
