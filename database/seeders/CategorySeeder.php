<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
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
            CategoryEloquentModel::create([ 'name' => $cat_name ]);
        }
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    /*public function run(): void
    {
        CategoryEloquentModel::factory(20)->create();
    }*/

}