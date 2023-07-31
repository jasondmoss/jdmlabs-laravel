<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Factories;

use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{

     protected $model = CategoryEloquentModel::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'id' => Str::ulid(),
            'name' => Str::title($faker->words(rand(1, 2), true)),
            'created_at' => Date::today()->subDays(rand(0, 365)),
            'updated_at' => Date::now()
        ];
    }

}
