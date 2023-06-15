<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

class TermFactory extends Factory {

    protected $model = Term::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'vocabulary_id' => function () {
                return Vocabulary::all()->random()->id;
            },

            'name' => $faker->unique()->text(80),
            'description' => $faker->unique()->text(1000),

            'created_at' => Date::today()->subDays(rand(0, 365)),
            'updated_at' => Date::now()
        ];
    }

}
