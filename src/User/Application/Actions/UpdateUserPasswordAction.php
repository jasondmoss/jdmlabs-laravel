<?php

declare(strict_types=1);

namespace Aenginus\User\Application\Actions;

use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPasswordAction implements UpdatesUserPasswords
{

    use PasswordValidationRulesAction;

    /**
     * Validate and update the user's password.
     *
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param array $input
     */
    final public function update(UserEloquentModel $user, array $input): void
    {
        Validator::make($input, [
            'current_password' => [
                'required',
                'string',
                'current_password:web'
            ],
            'password' => $this->passwordRules()
        ], [
            'current_password.current_password'
                => __('The provided password does not match your current password.')
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }

}
