<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->string('nomor_induk', 10)->unique();
            $table->string('username', 20);
            $table->string('nama', 255);
            $table->smallInteger('semester');
            $table->string('password', 255);
            $table->integer('jam_alpha');
            $table->integer('jam_kompen');
            $table->integer('jam_kompen_selesai');
            $table->foreignId('id_prodi')->constrained('prodi');
            $table->foreignId('id_level')->constrained('level');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
