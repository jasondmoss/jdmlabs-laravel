<?php

declare(strict_types=1);

namespace App\Core\User\Infrastructure\Factories;

use App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected $model = UserEloquentModel::class;


    public function definition(): array
    {
        return [
            'id' => Str::ulid(),
            'name' => 'Jason D. Moss',
            'email' => 'jason@jdmlabs.com',
            'email_verified_at' => now(),
            'password' => Hash::make(Config::get('jdmlabs.admin_password')),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }


    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

}
