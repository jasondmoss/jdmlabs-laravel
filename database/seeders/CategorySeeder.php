<?php

declare(strict_types=1);

namespace Database\Seeders;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\User\Domain\Models\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

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
            'API',
            'Books',
            'Clean Architecture',
            'CSS',
            'Development',
            'Domain Driven Development',
            'Dreamhost',
            'Drupal',
            'Fedora',
            'GitHub',
            'HTML',
            'JavaScript',
            'Laravel',
            'Linux',
            'Mountain Biking',
            'Mozilla',
            'MySQL',
            'NixOS',
            'Ottawa',
            'Photography',
            'PHPStorm',
            'Python',
            'Sublime Text',
            'Testing',
            'WordPress',
        ];

        foreach ($categories as $cat_name) {
            CategoryModel::create([
                'id' => (string) Str::ulid(),
                'name' => $cat_name,
                'user_id' => UserModel::whereEmail('jason@jdmlabs.com')->first()->id
            ]);
        }
    }
}
