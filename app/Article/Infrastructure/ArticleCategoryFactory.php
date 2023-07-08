<?php

declare(strict_types=1);

namespace App\Article\Infrastructure;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleCategoryFactory extends Factory
{

    protected $model = ArticleCategory::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->words(3, true))
        ];
    }

}
