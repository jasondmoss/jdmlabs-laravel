<?php

declare(strict_types=1);

namespace Aenginus\User\Application\Actions;

use Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel;
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
     * @param array $input
     *
     * @return \Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel
     */
    final public function create(array $input): UserEloquentModel
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(UserEloquentModel::class)
            ],
            'password' => $this->passwordRules()
        ])->validate();

        return UserEloquentModel::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);
    }

}
