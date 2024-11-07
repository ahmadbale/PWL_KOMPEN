<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    public function run()
    {
        DB::table('level')->insert([
            [
                'kode_level' => 'ADM',
                'nama_level' => 'Administrator'
            ],
            [
                'kode_level' => 'DSN',
                'nama_level' => 'Dosen'
            ],
            [
                'kode_level' => 'MHS',
                'nama_level' => 'Mahasiswa'
            ]
        ]);
    }
}