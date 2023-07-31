<?php

declare(strict_types=1);

namespace App\Core\User\Application\Actions;

use App\Core\Auth\Application\Actions\PasswordValidationRulesAction;
use App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUserAction implements CreatesNewUsers
{

    use PasswordValidationRulesAction;

    /**
     * Validate and create a newly registered user.
     *
     * @param array<string, string> $input
     */
    public function create(array $input): UserEloquentModel
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(UserEloquentModel::class)],
            'password' => $this->passwordRules()
        ])->validate();

        return UserEloquentModel::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);
    }

}
