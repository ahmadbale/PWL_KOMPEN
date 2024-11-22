<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KompenSeeder extends Seeder
{
    public function run()
    {
        // Data dummy untuk tabel kompen
        DB::table('kompen')->insert([
            [
                'nomor_kompen' => 'KP-ABC123-1690112345',
                'nama' => 'Piket Kebersihan',
                'deskripsi' => 'Melakukan piket kebersihan di area kampus.',
                'id_personil' => 29,
                'id_jenis_kompen' => 2,
                'kuota' => 20,
                'jam_kompen' => 2,
                'status' => 1,
                'is_selesai' => 0,
                'tanggal_mulai' => '2024-11-01',
                'tanggal_selesai' => '2024-11-07',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_kompen' => 'KP-DEF456-1690223456',
                'nama' => 'Piket Laboratorium',
                'deskripsi' => 'Melakukan piket di laboratorium TI.',
                'id_personil' => 29,
                'id_jenis_kompen' => 1,
                'kuota' => 15,
                'jam_kompen' => 3,
                'status' => 1,
                'is_selesai' => 0,
                'tanggal_mulai' => '2024-11-05',
                'tanggal_selesai' => '2024-11-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain di sini sesuai kebutuhan
        ]);
    }
}
