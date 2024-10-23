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
            $table->bigInteger("unitkerja_id")->nullable();
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('role');
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->longText('is_ditolak')->nullable();
            $table->text('remember_token')->change();
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