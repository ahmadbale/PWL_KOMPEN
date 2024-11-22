<?php

namespace Database\Seeders;

<<<<<<< HEAD
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
=======
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

        for ($i = 1; $i <= 30; $i++) {
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
                'id_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('mahasiswa')->insert($data);
>>>>>>> fd60cadf1c891c84847424257210cf7e3735a76b
    }
}
