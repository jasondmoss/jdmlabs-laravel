<?php

namespace Database\Seeders;

use App\Article\Infrastructure\ArticleSeeder;
use App\Auth\Infrastructure\UserSeeder;
use App\Client\Infrastructure\ClientSeeder;
use App\Project\Infrastructure\ProjectSeeder;
use App\Taxonomy\Infrastructure\TaxonomySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TaxonomySeeder::class,
            ClientSeeder::class,
            ProjectSeeder::class,
            ArticleSeeder::class
        ]);
    }

}
