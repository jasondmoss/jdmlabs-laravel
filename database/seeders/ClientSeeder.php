<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientSeeder extends Seeder
{

    use RefreshDatabase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ClientEloquentModel::factory(5)->create();
    }

}
