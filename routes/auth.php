<?php

declare(strict_types=1);

use Aenginus\User\Interface\Web\Controllers\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers as FC;

Route::middleware([ 'web' ])->group(function () {

    Route::redirect('/access', '/ae/access');

    Route::prefix('ae')->group(function () {
        $limiter = config('fortify.limiters.login');
        $twoFactorLimiter = config('fortify.limiters.two-factor');
        $verificationLimiter = config('fortify.limiters.verification', '6,1');

        /** -- Access. */

        Route::get('/access', [ FC\AuthenticatedSessionController::class, 'create' ])
            ->middleware([ 'guest:' . config('fortify.guard') ])
            ->name('access');

        Route::get('/access', function () {
            return view('ae.auth.access');
        })->name('access');

        Route::post('/access', [ FC\AuthenticatedSessionController::class, 'store' ])->middleware(array_filter([
            'guest:' . config('fortify.guard'),
            $limiter ? 'throttle:' . $limiter : null
        ]));

        Route::post('/logout', [ FC\AuthenticatedSessionController::class, 'destroy' ])
            ->name('logout');

        /** -- Password Reset. */

        if (Features::enabled(Features::resetPasswords())) {
            Route::get('/forgot-password', [ FC\PasswordResetLinkController::class, 'create' ])
                ->middleware([ 'guest:' . config('fortify.guard') ])
                ->name('password.request');

            Route::get('/reset-password/{token}', [ FC\NewPasswordController::class, 'create' ])
                ->middleware([ 'guest:' . config('fortify.guard') ])
                ->name('password.reset');

            Route::post('/forgot-password', [ FC\PasswordResetLinkController::class, 'store' ])
                ->middleware([ 'guest:' . config('fortify.guard') ])
                ->name('password.email');

            Route::post('/reset-password', [ FC\NewPasswordController::class, 'store' ])
                ->middleware([ 'guest:' . config('fortify.guard') ])
                ->name('password.update');
        }

        /** -- Registration. */

        if (Features::enabled(Features::registration())) {
            Route::get('/register', [ FC\RegisteredUserController::class, 'create' ])
                ->middleware([ 'guest:' . config('fortify.guard') ])
                ->name('register');

            Route::get('/register', function () {
                return view('ae.auth.register');
            })->name('register');

            Route::post('/register', [ FC\RegisteredUserController::class, 'store' ])
                ->middleware([ 'guest:' . config('fortify.guard') ]);
        }

        /** -- Email Verification. */

        if (Features::enabled(Features::emailVerification())) {
            Route::get('/email/verify', [ FC\EmailVerificationPromptController::class, '__invoke' ])
                ->middleware([ config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard') ])
                ->name('verification.notice');

            Route::get('/email/verify', function () {
                return view('ae.auth.email.verify');
            })->name('verification.notice');

            Route::get('/email/verify/{id}/{hash}', [ FC\VerifyEmailController::class, '__invoke' ])->middleware([
                config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'),
                'signed',
                'throttle:' . $verificationLimiter
            ])->name('verification.verify');

            Route::post('/email/verification-notification', [ FC\EmailVerificationNotificationController::class, 'store' ])->middleware([
                config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'),
                'throttle:' . $verificationLimiter
            ])->name('verification.send');
        }

        /** -- User Profile. */

        if (Features::enabled(Features::updateProfileInformation())) {
            Route::middleware([
                config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')
            ])->get('/user', function () {
                return view('ae.auth.account');
            })->name('account');

            Route::put('/user/profile-information', [ FC\ProfileInformationController::class, 'update' ])
                ->middleware([ config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard') ])
                ->name('user-profile-information.update');
        }

        /** -- Passwords. */

        if (Features::enabled(Features::updatePasswords())) {
            Route::put('/user/password', [ FC\PasswordController::class, 'update' ])
                ->middleware([ config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard') ])
                ->name('user-password.update');
        }

        /** -- Password Confirmation. */

        Route::get('/user/confirm-password', [ FC\ConfirmablePasswordController::class, 'show' ])
            ->middleware([ config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard') ]);

        Route::get('/user/confirm-password', function () {
            return view('ae.auth.password.confirm');
        })->name('password.confirm');

        Route::get('/user/confirmed-password-status', [ FC\ConfirmedPasswordStatusController::class, 'show' ])
            ->middleware([ config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard') ])
            ->name('password.confirmation');

        Route::post('/user/confirm-password', [ FC\ConfirmablePasswordController::class, 'store' ])
            ->middleware([ config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard') ])
            ->name('password.confirm');

        /** -- Two Factor Authentication. */

        if (Features::enabled(Features::twoFactorAuthentication())) {
            Route::get('/user/two-factor-challenge', [ FC\TwoFactorAuthenticatedSessionController::class, 'create' ])
                ->middleware([ 'guest:' . config('fortify.guard') ])
                ->name('two-factor.login');

            Route::get('/user/two-factor-challenge', function () {
                return view('ae.auth.2fa.challenge');
            })->name('two-factor.login');

            Route::post('/user/two-factor-challenge', [ FC\TwoFactorAuthenticatedSessionController::class, 'store' ])
                ->middleware(array_filter([
                    'guest:' . config('fortify.guard'),
                    $twoFactorLimiter ? 'throttle:' . $twoFactorLimiter : null,
                ]));

            $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
                ? [ config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'password.confirm' ]
                : [ config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard') ];

            Route::post('/user/two-factor-authentication', [ FC\TwoFactorAuthenticationController::class, 'store' ])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.enable');

            Route::post('/user/confirmed-two-factor-authentication', [ FC\ConfirmedTwoFactorAuthenticationController::class, 'store' ])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.confirm');

            Route::post('/two-factor-confirm', [ TwoFactorAuthController::class, '__invoke' ])
                ->name('two-factor.confirm');

            Route::delete('/user/two-factor-authentication', [ FC\TwoFactorAuthenticationController::class, 'destroy' ])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.disable');

            Route::get('/user/two-factor-qr-code', [ FC\TwoFactorQrCodeController::class, 'show' ])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.qr-code');

            Route::get('/user/two-factor-secret-key', [ FC\TwoFactorSecretKeyController::class, 'show' ])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.secret-key');

            Route::get('/user/two-factor-recovery-codes', [ FC\RecoveryCodeController::class, 'index' ])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.recovery-codes');

            Route::post('/user/two-factor-recovery-codes', [ FC\RecoveryCodeController::class, 'store' ])
                ->middleware($twoFactorMiddleware);
        }

    });

});
