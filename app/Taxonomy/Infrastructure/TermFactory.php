<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

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

            'name' => Str::title($faker->words(rand(1, 3), true)),
            'description' => $faker->unique()->text(200),

            'created_at' => Date::today()->subDays(rand(0, 365)),
            'updated_at' => Date::now()
        ];
    }

}
