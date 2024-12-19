<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonilAkademikSeeder extends Seeder
{
    public function run()
    {
        DB::table('personil_akademik')->insert([
            [
                'nomor_induk' => '198501012010121001',
                'username' => 'johndoe',
                'nama' => 'John Doe',
                'password' => Hash::make('password123'),
                'nomor_telp' => '081234567890',
                'id_level' => 2 // Dosen
            ],
            [
                'nomor_induk' => '199001012015121001',
                'username' => 'janedoe',
                'nama' => 'Jane Doe',
                'password' => Hash::make('password123'),
                'nomor_telp' => '081234567891',
                'id_level' => 2 // Dosen
            ]
        ]);
    }
}
