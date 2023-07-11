<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Database;

use App\Auth\Infrastructure\User;
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
        User::factory(1)->create();
    }

}
