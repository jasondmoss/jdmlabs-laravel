<?php

declare(strict_types=1);

use Aenginus\Shared\Enums\Promoted;
use Aenginus\Shared\Enums\Status;
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
        Schema::dropIfExists('clients');
        Schema::create('clients', static function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('slug');
            $table->string('itemprop')->default('');
            $table->string('website')->default('');
            $table->text('summary')->default('');

            $table->enum('status', Status::values());
            $table->enum('promoted', Promoted::values());

            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();

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
        Schema::dropIfExists('clients');
    }
};
