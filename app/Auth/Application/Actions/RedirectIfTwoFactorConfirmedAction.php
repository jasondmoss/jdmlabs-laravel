<?php

declare(strict_types=1);

namespace App\Auth\Application\Actions;

use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class RedirectIfTwoFactorConfirmedAction
    extends RedirectIfTwoFactorAuthenticatable {

    /**
     * @param $request
     * @param $next
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, $next): mixed
    {
        $user = $this->validateCredentials($request);

        if (optional($user)->two_factor_confirmed
            && in_array(TwoFactorAuthenticatable::class, class_uses_recursive($user))
        ) {
            return $this->twoFactorChallengeResponse($request, $user);
        }

        return $next($request);
    }

}
