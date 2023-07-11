<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Infrastructure\Database;

use App\Taxonomy\Category\Infrastructure\Category;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategorySeeder extends Seeder
{

    use RefreshDatabase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Category::factory(20)->create();
    }

}
