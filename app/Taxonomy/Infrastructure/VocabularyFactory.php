<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class VocabularyFactory extends Factory {

    protected $model = Vocabulary::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'name' => $faker->unique()->text(80),
            'description' => $faker->unique()->text(1000)
        ];
    }

}
