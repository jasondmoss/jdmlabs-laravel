<?php

declare(strict_types=1);

use Aenginus\Article\Interface\Web\Controllers as Article;
use Aenginus\Client\Interface\Web\Controllers as Client;
use Aenginus\Project\Interface\Web\Controllers as Project;
use Aenginus\Taxonomy\Interface\Web\Controllers as Category;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(static function () {

    Route::get('/articles', Article\PublishedController::class);
    Route::get('/article/{year}/{month}/{day}/{slug}', Article\SingleController::class);
    Route::get('/article/{slug}', Article\SingleController::class);

    Route::get('/clients', Client\PublishedController::class);
    Route::get('/client/{slug}', Client\SingleController::class);

    Route::get('/projects', Project\PublishedController::class);
    Route::get('/project/{slug}', Project\SingleController::class);


    // -- Dashboard (Redirect).
    Route::redirect('/ae', '/ae/dashboard');
    Route::redirect('/dashboard', '/ae/dashboard');

    Route::prefix('ae')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(static function () {

        Route::get('/dashboard', static function () {
            return view('aenginus.page.dashboard');
        })->name('dashboard');

        Route::get('/articles', Article\IndexController::class);
        Route::get('/article/create', Article\CreateController::class);
        Route::post('/article/create', Article\StoreController::class);
        Route::get('/article/edit/{id}', Article\EditController::class);
        Route::put('/article/update/{id}', Article\UpdateController::class);
        Route::delete('/article/{id}', Article\DestroyController::class);

        Route::get('/clients', Client\IndexController::class);
        Route::get('/client/create', Client\CreateController::class);
        Route::post('/client/create', Client\StoreController::class);
        Route::get('/client/edit/{id}', Client\EditController::class);
        Route::put('/client/update/{id}', Client\UpdateController::class);
        Route::delete('/client/{id}', Client\DestroyController::class);

        Route::get('/projects', Project\IndexController::class);
        Route::get('/project/create', Project\CreateController::class);
        Route::post('/project/create', Project\StoreController::class);
        Route::get('/project/edit/{id}', Project\EditController::class);
        Route::put('/project/update/{id}', Project\UpdateController::class);
        Route::delete('/project/{id}', Project\DestroyController::class);

        Route::get('/taxonomy/category', Category\IndexController::class);
        Route::get('/taxonomy/category/create', Category\CreateController::class);
        Route::post('/taxonomy/category/create', Category\StoreController::class);
        Route::get('/taxonomy/category/edit/{id}', Category\EditController::class);
        Route::put('/taxonomy/category/update/{id}', Category\UpdateController::class);
        Route::delete('/taxonomy/category/{id}', Category\DestroyController::class);

    });

});
