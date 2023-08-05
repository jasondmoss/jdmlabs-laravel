<?php

declare(strict_types=1);

namespace Database\Seeders;

use Aenginus\Project\Infrastructure\Eloquent\Models\ProjectEloquentModel;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectSeeder extends Seeder
{

    use RefreshDatabase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ProjectEloquentModel::factory(20)->create();
    }

}
