<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory {

    protected $model = User::class;


    public function definition(): array
    {
        return [
            'id' => Str::ulid(),
            'name' => 'Jason D. Moss',
            'email' => 'jason@jdmlabs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('&tS&^wxy*gTyu*98p7dtWsr@8BH!43h34o2z^6YU^x@Bgrs5b2'),
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
