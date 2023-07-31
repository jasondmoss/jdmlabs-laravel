<?php

declare(strict_types=1);

namespace App\Core\Laravel\Application;

use App\Core\Laravel\Application\Middleware as CoreMiddleware;
use Illuminate\Auth\Middleware as AuthMiddleware;
use Illuminate\Cookie\Middleware as CookieMiddleware;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Foundation\Http\Middleware as HttpFoundationMiddleware;
use Illuminate\Http\Middleware as HttpMiddleware;
use Illuminate\Routing\Middleware as RoutingMiddleware;
use Illuminate\Session\Middleware as SessionMiddleware;
use Illuminate\View\Middleware as ViewMiddleware;

class KernelHttp extends Kernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        CoreMiddleware\TrustHosts::class,
        CoreMiddleware\TrustProxies::class,
        HttpMiddleware\HandleCors::class,
        CoreMiddleware\PreventRequestsDuringMaintenance::class,
        HttpFoundationMiddleware\ValidatePostSize::class,
        CoreMiddleware\TrimStrings::class,
        HttpFoundationMiddleware\ConvertEmptyStringsToNull::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            CoreMiddleware\EncryptCookies::class,
            CookieMiddleware\AddQueuedCookiesToResponse::class,
            SessionMiddleware\StartSession::class,
            ViewMiddleware\ShareErrorsFromSession::class,
            CoreMiddleware\VerifyCsrfToken::class,
            RoutingMiddleware\SubstituteBindings::class
        ],

        'api' => [
            RoutingMiddleware\ThrottleRequests::class . ':api',
            RoutingMiddleware\SubstituteBindings::class
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used to conveniently assign middleware to routes and
     * groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => CoreMiddleware\Authenticate::class,
        'auth.basic' => AuthMiddleware\AuthenticateWithBasicAuth::class,
        'auth.session' => SessionMiddleware\AuthenticateSession::class,
        'cache.headers' => HttpMiddleware\SetCacheHeaders::class,
        'can' => AuthMiddleware\Authorize::class,
        'guest' => CoreMiddleware\RedirectIfAuthenticated::class,
        'password.confirm' => AuthMiddleware\RequirePassword::class,
        'signed' => CoreMiddleware\ValidateSignature::class,
        'throttle' => RoutingMiddleware\ThrottleRequests::class,
        'verified' => AuthMiddleware\EnsureEmailIsVerified::class
    ];

}
