<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Database;

use App\Client\Infrastructure\Client;
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
        Client::factory(5)->create();
    }

}