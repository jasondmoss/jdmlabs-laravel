<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware([ 'web' ])->group(function () {

    /** -- Public. */

    Route::get('/', function () {
        return view('public.page.home');
    })->name('home');

    Route::get('/about', function () {
        return view('public.page.about');
    })->name('about');

    Route::get('/now', function () {
        return view('public.page.now');
    })->name('now');


    /** -- Dashboard (Redirect). */

    Route::redirect('/ae', '/ae/dashboard');
    Route::redirect('/dashboard', '/ae/dashboard');

    /** -- Dashboard. */

    Route::prefix('ae')->middleware([
        config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('ae.page.dashboard');
        })->name('dashboard');

    });

});
