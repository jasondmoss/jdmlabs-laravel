<?php

declare(strict_types=1);

namespace Aenginus\Article\Infrastructure\Factories;

use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\User\Domain\Models\UserModel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

final class ArticleFactory extends Factory
{
    protected $model = ArticleModel::class;


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
            'id' => (string) Str::ulid(),
            'title' => $title,
            'summary' => $faker->text(170),
            'body' => $faker->paragraphs(4, true),
            'status' => 'published',
            'promoted' => 'not_promoted',
            'user_id' => UserModel::whereEmail('jason@jdmlabs.com')->first()->id,
            'published_at' => $created,
            'created_at' => $created,
            'updated_at' => Date::now()
        ];
    }
}
