<?php

declare(strict_types=1);

use App\Article\Application\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    // Public.
    Route::get('/articles', Controllers\PublishedController::class);
    Route::get('/article/{slug}', Controllers\SingleController::class);

    // Admin.
    Route::prefix('ae')->name('admin.')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {
        Route::get('/articles', Controllers\IndexController::class);
        Route::get('/article/create', Controllers\CreateController::class);
        Route::post('/article/create', Controllers\StoreController::class);
        Route::get('/article/edit/{id}', Controllers\EditController::class);
        Route::put('/article/update/{id}', Controllers\UpdateController::class);
        Route::delete('/article/{id}', Controllers\DestroyController::class);
    });

});
