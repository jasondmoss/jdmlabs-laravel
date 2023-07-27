<?php

declare(strict_types=1);

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    \App\Core\Laravel\Application\KernelHttp::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    \App\Core\Laravel\Application\KernelConsole::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    \App\Core\Laravel\Application\ExceptionHandler::class
);

return $app;
