<?php

namespace Database\Seeders;

use App\Article\Infrastructure\ArticleSeeder;
use App\Auth\Infrastructure\UserSeeder;
use App\Client\Infrastructure\ClientSeeder;
use App\Project\Infrastructure\ProjectSeeder;
use App\Taxonomy\Infrastructure\TermSeeder;
use App\Taxonomy\Infrastructure\VocabularySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VocabularySeeder::class,
            TermSeeder::class,
            ClientSeeder::class,
            ProjectSeeder::class,
            ArticleSeeder::class
        ]);
    }

}
