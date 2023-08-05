<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    Route::get('/', function () {
        return view('public.page.home');
    })->name('home');

    Route::get('/about', function () {
        return view('public.page.about');
    })->name('about');

    Route::get('/now', function () {
        return view('public.page.now');
    })->name('now');

    Route::get('/articles', \Aenginus\Article\Interface\Web\Controllers\PublishedController::class);
    Route::get('/article/{year}/{month}/{day}/{slug}', \Aenginus\Article\Interface\Web\Controllers\SingleController::class);
    Route::get('/article/{slug}', \Aenginus\Article\Interface\Web\Controllers\SingleController::class);

    Route::get('/clients', \Aenginus\Client\Interface\Web\Controllers\PublishedController::class);
    Route::get('/client/{slug}', \Aenginus\Client\Interface\Web\Controllers\SingleController::class);

    Route::get('/projects', \Aenginus\Project\Interface\Web\Controllers\PublishedController::class);
    Route::get('/project/{slug}', \Aenginus\Project\Interface\Web\Controllers\SingleController::class);


    // -- Dashboard (Redirect).
    Route::redirect('/ae', '/ae/dashboard');
    Route::redirect('/dashboard', '/ae/dashboard');

    Route::prefix('ae')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('ae.page.dashboard');
        })->name('dashboard');

        Route::get('/articles', \Aenginus\Article\Interface\Web\Controllers\IndexController::class);
        Route::get('/article/create', \Aenginus\Article\Interface\Web\Controllers\CreateController::class);
        Route::post('/article/create', \Aenginus\Article\Interface\Web\Controllers\StoreController::class);
        Route::get('/article/edit/{id}', \Aenginus\Article\Interface\Web\Controllers\EditController::class);
        Route::put('/article/update/{id}', \Aenginus\Article\Interface\Web\Controllers\UpdateController::class);
        Route::delete('/article/{id}', \Aenginus\Article\Interface\Web\Controllers\DestroyController::class);

        Route::get('/clients', \Aenginus\Client\Interface\Web\Controllers\IndexController::class);
        Route::get('/client/create', \Aenginus\Client\Interface\Web\Controllers\CreateController::class);
        Route::post('/client/create', \Aenginus\Client\Interface\Web\Controllers\StoreController::class);
        Route::get('/client/edit/{id}', \Aenginus\Client\Interface\Web\Controllers\EditController::class);
        Route::put('/client/update/{id}', \Aenginus\Client\Interface\Web\Controllers\UpdateController::class);
        Route::delete('/client/{id}', \Aenginus\Client\Interface\Web\Controllers\DestroyController::class);

        Route::get('/projects', \Aenginus\Project\Interface\Web\Controllers\IndexController::class);
        Route::get('/project/create', \Aenginus\Project\Interface\Web\Controllers\CreateController::class);
        Route::post('/project/create', \Aenginus\Project\Interface\Web\Controllers\StoreController::class);
        Route::get('/project/edit/{id}', \Aenginus\Project\Interface\Web\Controllers\EditController::class);
        Route::put('/project/update/{id}', \Aenginus\Project\Interface\Web\Controllers\UpdateController::class);
        Route::delete('/project/{id}', \Aenginus\Project\Interface\Web\Controllers\DestroyController::class);

        Route::get('/taxonomy/category', \Aenginus\Taxonomy\Interface\Web\Controllers\IndexController::class);
        Route::get('/taxonomy/category/create', \Aenginus\Taxonomy\Interface\Web\Controllers\CreateController::class);
        Route::post('/taxonomy/category/create', \Aenginus\Taxonomy\Interface\Web\Controllers\StoreController::class);
        Route::get('/taxonomy/category/edit/{id}', \Aenginus\Taxonomy\Interface\Web\Controllers\EditController::class);
        Route::put('/taxonomy/category/update/{id}', \Aenginus\Taxonomy\Interface\Web\Controllers\UpdateController::class);
        Route::delete('/taxonomy/category/{id}', \Aenginus\Taxonomy\Interface\Web\Controllers\DestroyController::class);

    });

});
