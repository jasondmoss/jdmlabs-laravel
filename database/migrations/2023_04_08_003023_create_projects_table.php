<?php

declare(strict_types=1);

use App\Shared\Domain\Enums\Pinned;
use App\Shared\Domain\Enums\Promoted;
use App\Shared\Domain\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
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
