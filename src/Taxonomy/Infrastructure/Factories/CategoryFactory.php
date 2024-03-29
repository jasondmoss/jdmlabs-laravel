<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Infrastructure\Factories;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

final class CategoryFactory extends Factory
{
    protected $model = CategoryModel::class;


    /**
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'id' => (string) Str::ulid(),
            'name' => Str::title($faker->words(random_int(1, 2), true)),
            'created_at' => Date::today()->subDays(random_int(0, 365)),
            'updated_at' => Date::now()
        ];
    }
}
