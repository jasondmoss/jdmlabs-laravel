<?php

declare(strict_types=1);

namespace Database\Seeders;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
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
        ArticleEloquentModel::factory(20)->create();
    }

}
