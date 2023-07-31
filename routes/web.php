<?php

declare(strict_types=1);

use App\Client\Application\Controllers as Client;
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

    Route::get('/articles', \App\Article\Interface\Http\Controllers\PublishedController::class);
    Route::get('/article/{slug}', \App\Article\Interface\Http\Controllers\SingleController::class);

    Route::get('/clients', Client\PublishedController::class);
    Route::get('/client/{slug}', Client\SingleController::class);

    Route::get('/projects', \App\Project\Interface\Http\Controllers\PublishedController::class);
    Route::get('/project/{slug}', \App\Project\Interface\Http\Controllers\SingleController::class);


    // -- Dashboard (Redirect).
    Route::redirect('/ae', '/ae/dashboard');
    Route::redirect('/dashboard', '/ae/dashboard');

    Route::prefix('ae')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('ae.page.dashboard');
        })->name('dashboard');

        Route::get('/articles', \App\Article\Interface\Http\Controllers\IndexController::class);
        Route::get('/article/create', \App\Article\Interface\Http\Controllers\CreateController::class);
        Route::post('/article/create', \App\Article\Interface\Http\Controllers\StoreController::class);
        Route::get('/article/edit/{id}', \App\Article\Interface\Http\Controllers\EditController::class);
        Route::put('/article/update/{id}', \App\Article\Interface\Http\Controllers\UpdateController::class);
        Route::delete('/article/{id}', \App\Article\Interface\Http\Controllers\DestroyController::class);

        Route::get('/clients', Client\IndexController::class);
        Route::get('/client/create', Client\CreateController::class);
        Route::post('/client/create', Client\StoreController::class);
        Route::get('/client/edit/{id}', Client\EditController::class);
        Route::put('/client/update/{id}', Client\UpdateController::class);
        Route::delete('/client/{id}', Client\DestroyController::class);

        Route::get('/projects', \App\Project\Interface\Http\Controllers\IndexController::class);
        Route::get('/project/create', \App\Project\Interface\Http\Controllers\CreateController::class);
        Route::post('/project/create', \App\Project\Interface\Http\Controllers\StoreController::class);
        Route::get('/project/edit/{id}', \App\Project\Interface\Http\Controllers\EditController::class);
        Route::put('/project/update/{id}', \App\Project\Interface\Http\Controllers\UpdateController::class);
        Route::delete('/project/{id}', \App\Project\Interface\Http\Controllers\DestroyController::class);

        Route::get('/taxonomy/category', \App\Taxonomy\Interface\Http\Controllers\IndexController::class);
        Route::get('/taxonomy/category/create', \App\Taxonomy\Interface\Http\Controllers\CreateController::class);
        Route::post('/taxonomy/category/create', \App\Taxonomy\Interface\Http\Controllers\StoreController::class);
        Route::get('/taxonomy/category/edit/{id}', \App\Taxonomy\Interface\Http\Controllers\EditController::class);
        Route::put('/taxonomy/category/update/{id}', \App\Taxonomy\Interface\Http\Controllers\UpdateController::class);
        Route::delete('/taxonomy/category/{id}', \App\Taxonomy\Interface\Http\Controllers\DestroyController::class);

    });

});
