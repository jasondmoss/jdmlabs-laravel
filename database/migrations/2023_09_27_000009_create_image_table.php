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

            $table->string('type');
            $table->string('filename');
            $table->string('width');
            $table->string('height');
            $table->string('label')->nullable();
            $table->string('alt')->nullable();
            $table->string('caption')->nullable();

            $table->timestamps();

//            $table->morphs('imageable');
            $table->ulid('imageable_id');
            $table->string('imageable_type');

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
