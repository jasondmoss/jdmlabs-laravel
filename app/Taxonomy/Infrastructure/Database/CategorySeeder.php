<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure\Database;

use App\Taxonomy\Infrastructure\Category;
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
        $categories = [
            'API', 'Books', 'Clean Architecture', 'CSS', 'Development',
            'Domain Driven Development', 'Dreamhost', 'Drupal', 'Fedora',
            'GitHub', 'HTML', 'JavaScript', 'Laravel', 'Linux',
            'Mountain Biking', 'Mozilla', 'MySQL', 'NixOS', 'Ottawa',
            'Photography', 'PHPStorm', 'Python', 'Sublime Text', 'Testing',
            'WordPress',
        ];

        foreach ($categories as $cat_name) {
            Category::create([ 'name' => $cat_name ]);
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