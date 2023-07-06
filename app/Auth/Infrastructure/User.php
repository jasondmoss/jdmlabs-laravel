<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticationProvider;

class User extends Authenticatable
{

    use HasFactory, HasUlids, Notifiable, TwoFactorAuthenticatable;

    public $timestamps = true;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];


    /**
     * @return Factory
     */
    protected static function factory(): Factory
    {
        return UserFactory::new();
    }


    /**
     * Enter your own logic (e.g. if ($this->id === 1) to enable this user to
     * be able to add/edit posts
     *
     * @return bool - true = User can edit/manage posts,
     *                false = User has no access to the admin panel
     */
    public function canManageContent(): bool
    {
        if ($this->email === config('admin_email', 'jason@jdmlabs.com')) {
            return true;
        }

        return false;
    }


    /**
     * @param string $code
     *
     * @return bool
     */
    public function confirmTwoFactorAuth(string $code): bool
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
