<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get(
    '/user',
    static function (Request $request) {
        return $request->user();
    }
);
