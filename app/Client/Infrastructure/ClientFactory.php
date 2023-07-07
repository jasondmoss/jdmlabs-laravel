<?php

declare(strict_types=1);

namespace App\Client\Infrastructure;

use App\Auth\Infrastructure\User;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{

    protected $model = Client::class;


    public function definition(): array
    {
        $faker = FakerFactory::create();

        $name = Str::title($faker->words(7, true));
        $slug = Str::of($name)->slug('-');

        return [
            'id' => Str::ulid(),
            'name' => $name,
            'slug' => $slug,
            'itemprop' => ucfirst($faker->word()),
            'website' => 'https://' . $faker->domainName() . '/',
            'summary' => $faker->text(170),

            'status' => $faker->randomElement(Status::values()),
            'promoted' => $faker->randomElement(Promoted::values()),

            'user_id' => User::whereEmail('jason@jdmlabs.com')->first()->id,

            'published_at' => $faker->randomElement([null, Date::now()]),

            'created_at' => Date::today()->subDays(rand(0, 365)),
            'updated_at' => Date::now()
        ];
    }

}
