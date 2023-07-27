<?php

declare(strict_types=1);

namespace App\Core\Auth\Application\Actions;

use Laravel\Fortify\Actions\DisableTwoFactorAuthentication as Disable2FA;

class DisableTwoFactorAuthenticationAction extends Disable2FA
{

    /**
     * @param $user
     *
     * @return void
     */
    public function __invoke($user): void
    {
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed' => 0,
        ])->save();
    }

}
