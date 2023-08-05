<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Infrastructure\Factories;

use Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

final class CategoryFactory extends Factory
{

     protected $model = CategoryEloquentModel::class;


    /**
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'id' => Str::ulid(),
            'name' => Str::title($faker->words(random_int(1, 2), true)),
            'created_at' => Date::today()->subDays(random_int(0, 365)),
            'updated_at' => Date::now()
        ];
    }

}
