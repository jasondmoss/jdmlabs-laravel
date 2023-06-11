<?php

declare(strict_types=1);

namespace App\Article\Infrastructure;

use App\Auth\Infrastructure\User;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
use Database\Seeders\DatabaseSeeder;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

final class ArticleFactory extends Factory {

    protected $model = Article::class;

    /*public DatabaseSeeder $seeder;


    public function __construct(DatabaseSeeder $seeder)
    {
        parent::__construct();

        $this->seeder = $seeder;
    }*/


    public function definition(): array
    {
        $faker = FakerFactory::create();

        $title = Str::title($faker->words(7, true));
        $slug = Str::of($title)->slug('-');

        $article = [
            'id' => Str::ulid(),
            'title' => $title,
            'slug' => $slug,
            'summary' => $faker->text(170),
            'body' => $faker->paragraphs(4, true),

            'status' => $faker->randomElement(Status::values()),
            'promoted' => $faker->randomElement(Promoted::values()),

            'user_id' => User::whereEmail('jason@jdmlabs.com')->first()->id,

            'published_at' => $faker->randomElement([ null, Date::now() ]),

            'created_at' => Date::today()->subDays(rand(0, 365)),
            'updated_at' => Date::now()
        ];

        return $article;
    }

    /*public function configure()
    {
        return $this
            ->afterMaking(function () {})
            ->afterCreating(function () {
                foreach (Article::all() as $article) {
                    $categories = Category::inRandomOrder()
                        ->limit(rand(1, 12))
                        ->get();

                    $article->categories()->sync($categories);
                }
            });
    }*/

}
