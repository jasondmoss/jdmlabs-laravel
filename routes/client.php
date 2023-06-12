<?php

declare(strict_types=1);

use App\Client\Application\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    Route::get('/clients', Controllers\PublishedController::class);
    Route::get('/client/{name}', Controllers\SingleController::class);

    Route::prefix('ae')->name('admin.')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {
        Route::get('/clients', Controllers\IndexController::class);
        Route::get('/client/create', Controllers\CreateController::class);
        Route::post('/client/create', Controllers\StoreController::class);
        Route::get('/client/edit/{id}', Controllers\EditController::class);
        Route::put('/client/update/{id}', Controllers\UpdateController::class);
        Route::delete('/client/{id}', Controllers\DestroyController::class);
    });

});
