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
        $items = [
            ['name' => 'API'],
            ['name' => 'Books'],
            ['name' => 'Clean Architecture'],
            ['name' => 'CSS'],
            ['name' => 'Development'],
            ['name' => 'Domain Driven Development'],
            ['name' => 'Dreamhost'],
            ['name' => 'Drupal'],
            ['name' => 'Fedora'],
            ['name' => 'GitHub'],
            ['name' => 'HTML'],
            ['name' => 'JavaScript'],
            ['name' => 'Laravel'],
            ['name' => 'Linux'],
            ['name' => 'Mountain Biking'],
            ['name' => 'Mozilla'],
            ['name' => 'MySQL'],
            ['name' => 'NixOS'],
            ['name' => 'Ottawa'],
            ['name' => 'Photography'],
            ['name' => 'PHPStorm'],
            ['name' => 'Python'],
            ['name' => 'Sublime Text'],
            ['name' => 'Testing'],
            ['name' => 'WordPress'],
        ];

        foreach ($items as $item) {
            Category::create($item);
        }
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    /*public function run(): void
    {
        Category::factory(20)->create();
    }*/

}
