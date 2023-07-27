<?php

namespace Database\Seeders;

use App\Article\Infrastructure\Database\ArticleSeeder;
use App\Auth\Infrastructure\Database\UserSeeder;
use App\Client\Infrastructure\Database\ClientSeeder;
use App\Project\Infrastructure\Database\ProjectSeeder;
use App\Taxonomy\Infrastructure\Database\CategorySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ClientSeeder::class,
            ProjectSeeder::class,
            ArticleSeeder::class
        ]);
    }

}
