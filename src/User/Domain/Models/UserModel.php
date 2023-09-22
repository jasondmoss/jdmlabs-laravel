<?php

declare(strict_types=1);

namespace Aenginus\User\Domain\Models;

use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Aenginus\User\Infrastructure\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticationProvider;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class UserModel extends UserEloquentModel
{

    use HasFactory, HasPermissions, HasRoles, HasUlids, TwoFactorAuthenticatable;


    /**
     * @return Factory
     */
    private static function newFactory(): Factory
    {
        return UserFactory::new();
    }


    /**
     * Enter your own logic (e.g. if ($this->id === 1) to enable this user to
     * be able to add/edit posts
     *
     * @return bool - true = UserEloquentModel can edit/manage posts,
     *                false = UserEloquentModel has no access to the admin panel
     */
    final public function canManageContent(): bool
    {
        return $this->canAny([

        ]);
    }


    /**
     * @param string $code
     *
     * @return bool
     */
    final public function confirmTwoFactorAuth(string $code): bool
    {
        $codeIsValid = app(TwoFactorAuthenticationProvider::class)
            ->verify(decrypt($this->two_factor_secret), $code);

        if ($codeIsValid) {
            $this->two_factor_confirmed = true;
            $this->save();

            return true;
        }

        return false;
    }

}
