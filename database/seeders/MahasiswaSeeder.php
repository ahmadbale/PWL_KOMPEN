<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('mahasiswa')->insert([
            [
                'nomor_induk' => '2241760097',
                'username' => '2241760097',
                'nama' => 'Ahmad Iqbal Firmansyah',
                'semester' => '5',
                'password' => '2241760097',
                'jam_alpha' => '2',
                'jam_kompen' => '2',
                'jam_kompen_selesai' => '0',
                'id_prodi' => '1',
                'id_level' => '3',
            ]
        ]);
    }
}
