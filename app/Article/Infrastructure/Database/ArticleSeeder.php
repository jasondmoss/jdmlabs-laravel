<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Database;

use App\Article\Infrastructure\Article;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleSeeder extends Seeder
{

    use RefreshDatabase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Article::factory(20)->create();
    }

}
