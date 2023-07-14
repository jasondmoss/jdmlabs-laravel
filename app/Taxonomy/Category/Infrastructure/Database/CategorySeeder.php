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
        $order = 0;
        $categories = [
            'API', 'Books', 'Clean Architecture', 'CSS', 'Development',
            'Domain Driven Development', 'Dreamhost', 'Drupal', 'Fedora',
            'GitHub', 'HTML', 'JavaScript', 'Laravel', 'Linux',
            'Mountain Biking', 'Mozilla', 'MySQL', 'NixOS', 'Ottawa',
            'Photography', 'PHPStorm', 'Python', 'Sublime Text', 'Testing',
            'WordPress',
        ];

        foreach ($categories as $cat_name) {
            Category::create([
                'name' => $cat_name,
                'order' => $order++
            ]);
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
