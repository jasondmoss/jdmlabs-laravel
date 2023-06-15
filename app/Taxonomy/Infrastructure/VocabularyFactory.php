<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VocabularyFactory extends Factory {

    protected $model = Vocabulary::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'name' => Str::title($faker->words(rand(1, 5), true)),
            'description' => $faker->unique()->text(200)
        ];
    }

}
