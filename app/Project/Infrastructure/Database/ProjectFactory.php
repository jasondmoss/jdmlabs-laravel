<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Database;

use App\Auth\Infrastructure\User;
use App\Client\Infrastructure\Client;
use App\Project\Infrastructure\Project;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{

    protected $model = Project::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        $title = Str::title($faker->sentence(10, true));
        $slug = Str::of($title)->slug('-');

        return [
            'id' => Str::ulid(),
            'title' => $title,
            'slug' => $slug,
            'subtitle' => $faker->sentence(),
            'website' => 'https://' . $faker->domainName() . '/',
            'summary' => $faker->text(170),
            'body' => $faker->paragraphs(2, true),

            /*'status' => $faker->randomElement(Status::values()),*/
            /*'promoted' => $faker->randomElement(Promoted::values()),*/
            /*'pinned' => $faker->randomElement(Pinned::values()),*/
            'status' => 'published',
            'promoted' => 'not_promoted',
            'pinned' => 'not_pinned',

            'client_id' => Client::inRandomOrder()->first(),
            'user_id' => User::whereEmail('jason@jdmlabs.com')->first()->id,

            'published_at' => $faker->randomElement([null, Date::now()]),

            'created_at' => Date::today()->subDays(rand(0, 365)),
            'updated_at' => Date::now()
        ];
    }

}
