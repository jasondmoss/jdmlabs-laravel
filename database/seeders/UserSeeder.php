<?php

declare(strict_types=1);

namespace Database\Seeders;

use Aenginus\User\Infrastructure\Eloquent\Models\UserEloquentModel;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSeeder extends Seeder
{

    use RefreshDatabase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UserEloquentModel::factory(1)->create();
    }

}
