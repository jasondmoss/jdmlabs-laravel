<?php

declare(strict_types=1);

namespace Aenginus\Article\Infrastructure\Factories;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\User\Infrastructure\EloquentModels\UserEloquentModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

final class ArticleFactory extends Factory
{

    protected $model = ArticleEloquentModel::class;


    /**
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $faker = FakerFactory::create();

        $title = Str::title($faker->words(7, true));
        $created = Date::today()->subDays(random_int(0, 365));

        return [
            'id' => Str::ulid(),
            'title' => $title,
            'summary' => $faker->text(170),
            'body' => $faker->paragraphs(4, true),

            'status' => 'published',
            'promoted' => 'not_promoted',

            'user_id' => UserEloquentModel::whereEmail('jason@jdmlabs.com')
                ->first()
                ->id,

            'published_at' => $created,

            'created_at' => $created,
            'updated_at' => Date::now()
        ];
    }

}