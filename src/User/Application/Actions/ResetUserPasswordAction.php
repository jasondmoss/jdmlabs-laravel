<?php

declare(strict_types=1);

namespace Aenginus\User\Application\Actions;

use Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPasswordAction implements ResetsUserPasswords
{

    use PasswordValidationRulesAction;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param \Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel $user
     * @param array $input
     */
    final public function reset(UserEloquentModel $user, array $input): void
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }

}
