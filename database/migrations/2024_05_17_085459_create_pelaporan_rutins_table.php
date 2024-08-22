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
        Schema::create('pelaporan_rutins', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->dateTime("tanggal_lapor");
            $table->string("nama_sistem");
            $table->string("versi");
            $table->longText("deskripsi");
            $table->text("dokumen");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan_rutins');
    }
};
