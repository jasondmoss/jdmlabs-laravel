<?php

declare(strict_types=1);

namespace App\Taxonomy\Infrastructure;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VocabularySeeder extends Seeder {

    use RefreshDatabase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Vocabulary::factory(3)->create();
    }

}
