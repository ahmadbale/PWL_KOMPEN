<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        DB::table('prodi')->insert([
            [
                'kode_prodi' => 'SIB',
                'nama_prodi' => 'D4 Sistem Informasi Bisnis'
            ],
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'D4 Teknik Informatika'
            ]
        ]);
    }
}
