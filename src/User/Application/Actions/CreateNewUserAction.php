<?php

declare(strict_types=1);

namespace Aenginus\User\Application\Actions;

use Aenginus\User\Domain\Models\UserModel;
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
     * @return \Aenginus\User\Domain\Models\UserModel
     */
    final public function create(array $input): UserModel
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(UserModel::class)
            ],
            'password' => $this->passwordRules()
        ])->validate();

        return UserModel::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);
    }
}
