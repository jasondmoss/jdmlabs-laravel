<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\Factories;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Core\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use App\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{

    protected $model = ProjectEloquentModel::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        $title = Str::title($faker->sentence(10, true));
        $created = Date::today()->subDays(rand(0, 365));

        return [
            'id' => Str::ulid(),
            'title' => $title,
            'subtitle' => $faker->sentence(),
            'website' => 'https://' . $faker->domainName() . '/',
            'summary' => $faker->text(170),
            'body' => $faker->paragraphs(2, true),

            'status' => 'published',
            'promoted' => 'not_promoted',
            'pinned' => 'not_pinned',

            'client_id' => ClientEloquentModel::inRandomOrder()->first(),
            'user_id' => UserEloquentModel::whereEmail('jason@jdmlabs.com')->first()->id,

            'published_at' => $created,

            'created_at' => $created,
            'updated_at' => Date::now()
        ];
    }

}