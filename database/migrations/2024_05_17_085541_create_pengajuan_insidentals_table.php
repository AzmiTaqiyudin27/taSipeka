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
        Schema::create('pengajuan_insidentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->dateTime("tanggal_pengajuan");
            $table->string("nama_sistem");
            $table->string("kendala");
            $table->longText("keterangan");
            $table->text("foto");
            $table->integer("status_approved");
            $table->longText("is_ditolak");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan_insidentals');
    }
};
