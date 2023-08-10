<?php

declare(strict_types=1);

namespace Aenginus\User\Application\Actions;

use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformationAction implements UpdatesUserProfileInformation
{

    /**
     * Validate and update the given user's profile information.
     *
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param array $input
     */
    final public function update (UserEloquentModel $user, array $input): void
    {
        Validator::make($input, [
            'name' => [ 'required', 'string', 'max:255' ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }


    /**
     * Update the given verified user's profile information.
     *
     * @param \Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel $user
     * @param array $input
     */
    private function updateVerifiedUser (UserEloquentModel $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

}