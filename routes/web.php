<?php

declare(strict_types=1);

use App\Article\Application\Controllers as Article;
use App\Client\Application\Controllers as Client;
use App\Project\Application\Controllers as Project;
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

    Route::get('/articles', Article\PublishedController::class);
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
    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('ae.page.dashboard');
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

        Route::get('/taxonomy/category', \App\Taxonomy\Category\Application\Controllers\IndexController::class);
        Route::get('/taxonomy/category/create', \App\Taxonomy\Category\Application\Controllers\CreateController::class);
        Route::post('/taxonomy/category/create', \App\Taxonomy\Category\Application\Controllers\StoreController::class);
        Route::get('/taxonomy/category/edit/{id}', \App\Taxonomy\Category\Application\Controllers\EditController::class);
        Route::put('/taxonomy/category/update/{id}', \App\Taxonomy\Category\Application\Controllers\UpdateController::class);
        Route::delete('/taxonomy/category/{id}', \App\Taxonomy\Category\Application\Controllers\DestroyController::class);

    });

});
