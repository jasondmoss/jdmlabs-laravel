<?php

declare(strict_types=1);

use Aenginus\Shared\Enums\Pinned;
use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('projects');
        Schema::create('projects', static function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('title');
            $table->string('slug');
            $table->string('subtitle')->default('');
            $table->string('website')->default('');
            $table->string('summary')->default('');
            $table->text('body')->default('');

            $table->enum('status', Status::values());
            $table->enum('promoted', Promoted::values());
            $table->enum('pinned', Pinned::values());

            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();

            $table->ulid('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('projects');
    }

};
