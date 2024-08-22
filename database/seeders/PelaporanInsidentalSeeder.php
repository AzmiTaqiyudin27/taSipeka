<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelaporanInsidentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelaporan_rutins')->insert([
            'id' => 1,
            'user_id' => 1,
            'tanggal_lapor' => now(),
            'nama_sistem' => 'Sistem_Informasi_Kerja_Praktek',
            'kendala' => 'muncul iklan di dashboard',
            'keterangan' => 'iklannya judi online',
        ]);
}
}
