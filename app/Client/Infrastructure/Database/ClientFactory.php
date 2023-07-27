<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Database;

use App\Client\Infrastructure\Client;
use App\Core\User\Infrastructure\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{

    protected $model = Client::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        $name = Str::title($faker->words(7, true));
        $slug = Str::of($name)->slug('-');
        $created = Date::today()->subDays(rand(0, 365));

        return [
            'id' => Str::ulid(),
            'name' => $name,
            'slug' => $slug,
            'itemprop' => ucfirst($faker->word()),
            'website' => 'https://' . $faker->domainName() . '/',
            'summary' => $faker->text(170),

            /*'status' => $faker->randomElement(Status::values()),*/
            /*'promoted' => $faker->randomElement(Promoted::values()),*/
            'status' => 'published',
            'promoted' => 'not_promoted',

            'user_id' => User::whereEmail('jason@jdmlabs.com')->first()->id,

//            'published_at' => $faker->randomElement([ $created, Date::now() ]),
            'published_at' => $created,

            'created_at' => $created,
            'updated_at' => Date::now()
        ];
    }

}
