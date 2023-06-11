<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 80)->index()->unique();
            $table->string('url', 1000)->nullable();
            $table->string('description', 1000)->nullable();
            $table->integer('weight')->default(0);
            $table->boolean('is_active')->default(true);

            /**
             * Column to use when moving data from old single-purpose tables to
             * taxonomy terms it will hold the primary key of the old table.
             */
            $table->integer('legacy_id')->nullable();

            // NestedSet package hierarchy columns
            $table->unsignedInteger('left')->default(0)->index();
            $table->unsignedInteger('right')->default(0)->index();
            $table->unsignedInteger('parent_id')->nullable()->index();

            $table->timestamps();

            $table->unsignedInteger('vocabulary_id');
            $table->foreign('vocabulary_id')
                ->references('id')
                ->on('vocabularies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
