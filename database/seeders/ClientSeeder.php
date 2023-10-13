<?php

declare(strict_types=1);

namespace Database\Seeders;

use Aenginus\Client\Domain\Models\ClientModel;
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
        ClientModel::factory(5)->create();
    }
}
