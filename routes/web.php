<?php

declare(strict_types=1);

use Aenginus\Article\Interface\Web\Controllers as Article;
use Aenginus\Client\Interface\Web\Controllers as Client;
use Aenginus\Project\Interface\Web\Controllers as Project;
use Aenginus\Taxonomy\Interface\Web\Controllers as Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

Route::middleware(['web'])->group(static function () {

    // Article
    Route::get('/articles', Article\PublishedController::class)
        ->name('article-list');
    Route::get('/article/{year}/{month}/{day}/{slug}', Article\SingleController::class)
        ->name('article-single');
    Route::redirect('/article/{slug}', '/article/{year}/{month}/{day}/{slug}');

    // Client
    Route::get('/clients', Client\PublishedController::class)
        ->name('client-list');
    Route::get('/client/{slug}', Client\SingleController::class)
        ->name('client-single');

    // ProjectModel
    Route::get('/projects', Project\PublishedController::class)
        ->name('project-list');
    Route::get('/project/{client_slug}/{slug}', Project\SingleController::class)
        ->name('project-single');

//    Route::get('/taxonomy/category/{slug}', Category\SingleController::class)
//        ->name('category-single');

    // --

    Route::get('storage/images/{size}/{filename}', static function ($size, $filename) {
        $image = Image::cache(static function ($image) use ($filename, $size) {
            return $image->make(storage_path("app/public/images/{$filename}"))->fit($size);
        }, 1440, true);

        return $image->response('png');
    })->where('size', '\d+x\d+')->where('filename', '.*');


    // -- Dashboard (Redirect).
    Route::redirect('/ae', '/ae/dashboard');
    Route::redirect('/ae/register', '/ae/access');
    Route::redirect('/dashboard', '/ae/dashboard');
    Route::redirect('/register', '/ae/access');


    Route::prefix('ae')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(static function () {

        // Dashboard
        Route::get('/dashboard', static function () {
            return view('aenginus.page.dashboard');
        })->name('dashboard');

        // Article
        Route::get('/articles', Article\IndexController::class)
            ->name('ae-article-list');
        Route::get('/article/create', Article\CreateController::class)
            ->name('ae-article-create');
        Route::post('/article/create', Article\StoreController::class);
        Route::get('/article/edit/{id}', Article\EditController::class)
            ->name('ae-article-edit');
        Route::put('/article/update/{id}', Article\UpdateController::class);
        Route::delete('/article/{id}', Article\DestroyController::class);

        // Client
        Route::get('/clients', Client\IndexController::class)
            ->name('ae-client-list');
        Route::get('/client/create', Client\CreateController::class)
            ->name('ae-client-create');
        Route::post('/client/create', Client\StoreController::class);
        Route::get('/client/edit/{id}', Client\EditController::class)
            ->name('ae-client-edit');
        Route::put('/client/update/{id}', Client\UpdateController::class);
        Route::delete('/client/{id}', Client\DestroyController::class);

        // ProjectModel
        Route::get('/projects', Project\IndexController::class)
            ->name('ae-project-list');
        Route::get('/project/create', Project\CreateController::class)
            ->name('ae-project-create');
        Route::post('/project/create', Project\StoreController::class);
        Route::get('/project/edit/{id}', Project\EditController::class)
            ->name('ae-project-edit');
        Route::put('/project/update/{id}', Project\UpdateController::class);
        Route::delete('/project/{id}', Project\DestroyController::class);

        // Taxonomy: Category
        Route::get('/taxonomy/category', Category\IndexController::class)
            ->name('ae-category-list');
        Route::get('/taxonomy/category/create', Category\CreateController::class)
            ->name('ae-category-create');
        Route::post('/taxonomy/category/create', Category\StoreController::class);
        Route::get('/taxonomy/category/edit/{id}', Category\EditController::class)
            ->name('ae-category-edit');
        Route::put('/taxonomy/category/update/{id}', Category\UpdateController::class);
        Route::delete('/taxonomy/category/{id}', Category\DestroyController::class);

        // Clear cache.
        Route::get('/clear', static function () {
            Cache::flush();

            return back()->with('update', 'All caches have been cleared.');
        })->name('clear-cache');

    });

});
