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
        Schema::create('audit_insidentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId("pelaporan_insidental_id");
            $table->foreignId("user_id");
            $table->string("pendahuluan");
            $table->string("cakupan_audit");
            $table->string("tujuan_audit");
            $table->string("metodologi_audit");
            $table->string("hasil_audit");
            $table->string("rekomendasi");
            $table->string("kesimpulan_audit");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_insidentals');
    }
};
