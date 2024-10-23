<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('audit_rutins')->insert([
            'kode_audit' => 'A0001',
            'user_id' => 1,
            'unitkerja_id' => 2,
            'tanggal_mulai' => '2022-01-01',    
            'tanggal_selesai' => '2022-01-01',
            'versi' => '1.0.0', 
            'pendahuluan' => 'Pendahuluan',
            'judul' => 'Judul',
            'cakupan_audit' => 'Cakupan Audit',
            'tujuan_audit' => 'Tujuan Audit',
            'rekomendasi' => 'Rekomendasi',
            'metodologi_audit' => 'Metodologi Audit',
            'kesimpulan_audit' => 'Kesimpulan Audit',
            'hasil_audit' => 'Fakta Audit',
            'status' => 'Draft',
        ]);
    }
}
