<?php

declare(strict_types=1);

namespace App\Core\User\Application\Actions;

use App\Core\Auth\Application\Actions\PasswordValidationRulesAction;
use App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPasswordAction implements ResetsUserPasswords
{

    use PasswordValidationRulesAction;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param array<string, string> $input
     */
    public function reset(UserEloquentModel $user, array $input): void
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }

}
