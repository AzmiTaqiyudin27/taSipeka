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
        Schema::create('audit_rutins', function (Blueprint $table) {
            $table->id();
            $table->string("pelaporan_rutin_id");
            $table->foreignId("user_id");
            $table->dateTime("tanggal_audit");
            $table->string("nama_sistem");
            $table->string("versi");
            $table->string("keamanan_sistem");
            $table->string("bahasa_pemrograman");
            $table->string("farmework");
            $table->string("maksimum_penyimpanan");
            $table->string("maksimum_pengguna");
            $table->string("pengguna_sistem");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_rutins');
    }
};