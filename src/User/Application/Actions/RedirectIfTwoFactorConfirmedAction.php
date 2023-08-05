<?php

declare(strict_types=1);

namespace Aenginus\User\Application\Actions;

use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class RedirectIfTwoFactorConfirmedAction
    extends RedirectIfTwoFactorAuthenticatable
{

    /**
     * @param $request
     * @param $next
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    final public function handle($request, $next): mixed
    {
        parent::handle($request, $next);

        $user = $this->validateCredentials($request);

        if ($user?->two_factor_confirmed && in_array(
            TwoFactorAuthenticatable::class,
            class_uses_recursive($user),
            true
        )) {
            return $this->twoFactorChallengeResponse($request, $user);
        }

        return $next($request);
    }

}
