<?php

declare(strict_types=1);

namespace App\Project\Infrastructure;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectSeeder extends Seeder {

    use RefreshDatabase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Project::factory(20)->create();
    }

}
