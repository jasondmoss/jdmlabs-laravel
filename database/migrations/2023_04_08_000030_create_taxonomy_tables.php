<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('slug')->nullable()->index();
            $table->text('description')->nullable();

            $table->unsignedInteger('_lft')->default(0);
            $table->unsignedInteger('_rgt')->default(0);
            $table->ulid('parent_id')->nullable();
            $table->integer('weight')->default(0);

            $table->string('vocabulary')->index();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('termables', function (Blueprint $table) {
            $table->ulid('term_id')->nullable();
            $table->foreign('term_id')
                ->references('id')
                ->on('terms')
                ->onDelete('cascade');

            $table->morphs('termable');

            $table->unsignedInteger('weight')->default(0);
            $table->string('comment')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termables');
        Schema::dropIfExists('terms');
    }

};
