<?php

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
        Schema::dropIfExists('images');
        Schema::create('images', static function (Blueprint $table) {
            $table->ulid('id')->primary();

            // $table->string('collection')->default('original');
            $table->string('filename');
            $table->string('filepath');
            $table->json('responsive');
            $table->string('width');
            $table->string('height');
            $table->string('label')->nullable();
            $table->string('alt')->nullable();
            $table->string('caption')->nullable();

            $table->timestamps();

            $table->ulid('imageable_id');
            $table->string('imageable_type');

            $table->ulid('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');

            $table->ulid('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }

};