<?php

declare(strict_types=1);

use App\Article\Application\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    // Public.
    Route::get('/articles', Controllers\ArticlePublicIndexController::class);
    Route::get('/article/{slug}', Controllers\ArticlePublicShowController::class);

    // Admin.
    Route::prefix('ae')->name('admin.')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {
        Route::get('/articles', Controllers\ArticleAdminIndexController::class);
        Route::get('/article/create', Controllers\ArticleAdminCreateController::class);
        Route::post('/article/create', Controllers\ArticleAdminStoreController::class);
        Route::get('/article/edit/{id}', Controllers\ArticleAdminEditController::class);
        Route::put('/article/update/{id}', Controllers\ArticleAdminUpdateController::class);
        Route::delete('/article/{id}', Controllers\ArticleAdminDestroyController::class);
    });

});
