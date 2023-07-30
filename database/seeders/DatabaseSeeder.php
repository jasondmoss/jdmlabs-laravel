<?php

namespace Database\Seeders;

use App\Client\Infrastructure\Database\ClientSeeder;
use App\Core\User\Infrastructure\Database\UserSeeder;
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
