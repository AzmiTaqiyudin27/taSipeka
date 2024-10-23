<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'unitkerja_id' => null,
            'username' => 'Tim Keamanan dan Audit Sistem Informasi',
            'email' => 'timkeamananaudit@gmail.com',
            'role' => 'audit',
            'password' => bcrypt('password'),
            'is_active' => true,
            'is_ditolak' => null
        ]);

       

        //nambah user dummy
        // DB::table('users')->insert([
        //     'name' => 'Ana',
        //     'nip' => '1122334455',
        //     'email' => 'cek1@gmail.com',
        //     'alamat' => 'purwokerto',
        //     'role' => 'unit kerja',
        //     'foto' => 'unitKerja.svg',
        //     'password' => bcrypt('password')
        // ]);
    }
}
