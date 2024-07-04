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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('birth_date')->nullable();
            $table->boolean('telephone_verified')->nullable()->defaut(false);
            $table->timestamp('telephone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('deleted_at', $precision = 0)->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role')->nullable();
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
