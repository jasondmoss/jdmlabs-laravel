<?php

declare(strict_types=1);

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
        Schema::create('articles', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('summary')->default('');
            $table->longText('body')->default('');

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
        Schema::dropIfExists('articles');
    }

};
