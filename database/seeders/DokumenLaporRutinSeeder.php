<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenLaporRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dokumen_lapor_rutins')->insert([
            'pelaporan_rutin_id' => 1,
            'nama_file' => 'Dokumentasi_Website_Sistem Informasi_Kerja_Praktek.pdf',
        ]);
    }
}
