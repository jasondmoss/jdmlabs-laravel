<?php

declare(strict_types=1);

namespace Aenginus\User\Application\Providers;

use Aenginus\Shared\Providers\SharedServiceProvider;
use Aenginus\User\Application\Actions\CreateNewUserAction;
use Aenginus\User\Application\Actions\RedirectIfTwoFactorConfirmedAction;
use Aenginus\User\Application\Actions\ResetUserPasswordAction;
use Aenginus\User\Application\Actions\UpdateUserPasswordAction;
use Aenginus\User\Application\Actions\UpdateUserProfileInformationAction;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

final class FortifyServiceProvider extends SharedServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        Fortify::ignoreRoutes();

        parent::register();
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUserAction::class);

        Fortify::updateUserProfileInformationUsing(
            UpdateUserProfileInformationAction::class
        );

        Fortify::updateUserPasswordsUsing(UpdateUserPasswordAction::class);

        Fortify::resetUserPasswordsUsing(ResetUserPasswordAction::class);

        Fortify::authenticateThrough(static function () {
            return array_filter([
                config('fortify.limiters.login')
                    ? null : EnsureLoginIsNotThrottled::class,
                Features::enabled(Features::twoFactorAuthentication())
                    ? RedirectIfTwoFactorConfirmedAction::class : null,
                AttemptToAuthenticate::class,
                PrepareAuthenticatedSession::class,
            ]);
        });

        $this->app->bind(DisableTwoFactorAuthentication::class, static function () {
            return new DisableTwoFactorAuthentication();
        });

        RateLimiter::for('login', static function (Request $request) {
            $email = (string)$request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', static function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Route::group([
            'namespace' => 'App\\Laravel\\Application\\Controllers',
            'domain' => config('fortify.domain'),
            'prefix' => config('fortify.prefix'),
        ], function () {
            $this->loadRoutesFrom(base_path('routes/auth.php'));
        });

        parent::boot();
    }

}
