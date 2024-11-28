<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 2; $i++) {
            $data[] = [
                'nomor_induk' => str($i, 10, '0', STR_PAD_LEFT), // nomor_induk dengan format 10 digit
                'username' => 'mahasiswa' . $i,
                'nama' => 'Mahasiswa ' . $i,
                'semester' => rand(1, 8),
                'password' => Hash::make('password' . $i),
                'jam_alpha' => rand(0, 10),
                'jam_kompen' => rand(5, 20),
                'jam_kompen_selesai' => rand(0, 5),
                'id_prodi' => 3,
                'id_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('mahasiswa')->insert($data);
    }
}
