<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('users');
        Schema::create('users', static function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();

            if (Fortify::confirmsTwoFactorAuthentication()) {
                $table->boolean('two_factor_confirmed')->default(false);
                $table->timestamp('two_factor_confirmed_at')->nullable();
            }

            $table->rememberToken();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }

};
