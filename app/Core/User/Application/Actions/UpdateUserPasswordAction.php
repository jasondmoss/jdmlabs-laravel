<?php

declare(strict_types=1);

namespace App\Core\User\Application\Actions;

use App\Core\Auth\Application\Actions\PasswordValidationRulesAction;
use App\Core\User\Infrastructure\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPasswordAction implements UpdatesUserPasswords
{

    use PasswordValidationRulesAction;

    /**
     * Validate and update the user's password.
     *
     * @param array<string, string> $input
     */
    public function update(User $user, array $input): void
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
