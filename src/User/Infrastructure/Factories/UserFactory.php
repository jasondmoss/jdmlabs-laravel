<?php

declare(strict_types=1);

namespace Aenginus\User\Infrastructure\Factories;

use Aenginus\User\Domain\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{

    protected $model = UserModel::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => (string)Str::ulid(),
            'name' => 'Jason D. Moss',
            'email' => Config::get('jdmlabs.admin.admin_email'),
            'email_verified_at' => now(),
            'password' => Hash::make(Config::get('jdmlabs.admin.admin_password')),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }


    /**
     * @return self
     */
    public function unverified(): self
    {
        return $this->state(static fn(array $attributes) => [
            'email_verified_at' => null
        ]);
    }

}
