<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonilAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i = 1; $i <= 1000; $i++) { // Menghasilkan 10 contoh data
            $data[] = [
                'nomor_induk' => Str::random(18), // nomor_induk acak dengan panjang 18 karakter
                'username' => 'user' . $i,
                'nama' => 'Personil ' . $i,
                'password' => Hash::make('password' . $i),
                'nomor_telp' => '08123456789' . $i,
                'id_level' => 4, // id_level acak antara 1 dan 5
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('personil_akademik')->insert($data);
    }
}
