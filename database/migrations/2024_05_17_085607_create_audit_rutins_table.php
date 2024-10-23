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
            $table->string("kode_audit");
            $table->bigInteger("user_id");
            $table->bigInteger("unitkerja_id");
            $table->dateTime("tanggal_mulai");
            $table->dateTime("tanggal_selesai");
            $table->string("versi");
            $table->string("pendahuluan");
            $table->string("judul");
            $table->string("cakupan_audit");
            $table->string("tujuan_audit");
            $table->string("rekomendasi");
            $table->string("metodologi_audit");
            $table->string("kesimpulan_audit");
            $table->string("hasil_audit");
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