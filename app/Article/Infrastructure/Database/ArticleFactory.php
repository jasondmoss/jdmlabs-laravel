<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Database;

use App\Article\Infrastructure\Article;
use App\Auth\Infrastructure\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

final class ArticleFactory extends Factory
{

    protected $model = Article::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        $title = Str::title($faker->words(7, true));
        $created = Date::today()->subDays(rand(0, 365));

        return [
            'id' => Str::ulid(),
            'title' => $title,
            'summary' => $faker->text(170),
            'body' => $faker->paragraphs(4, true),

            'status' => 'published',
            'promoted' => 'not_promoted',

//            'category_id' => '',

            'user_id' => User::whereEmail('jason@jdmlabs.com')->first()->id,

            'published_at' => $created,

            'created_at' => $created,
            'updated_at' => Date::now()
        ];
    }

}
