<?php

declare(strict_types=1);

use App\Client\Application\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    Route::get('/clients', Controllers\ClientPublicPublishedController::class);
    Route::get('/client/{name}', Controllers\ClientPublicSingleController::class);

    Route::prefix('ae')->name('admin.')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {
        Route::get('/clients', Controllers\ClientAdminListController::class);
        Route::get('/client/create', Controllers\ClientAdminCreateController::class);
        Route::post('/client/create', Controllers\ClientAdminStoreController::class);
        Route::get('/client/edit/{id}', Controllers\ClientAdminEditController::class);
        Route::put('/client/update/{id}', Controllers\ClientAdminUpdateController::class);
        Route::delete('/client/{id}', Controllers\ClientAdminDestroyController::class);
    });

});
