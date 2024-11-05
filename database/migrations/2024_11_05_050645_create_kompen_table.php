<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompenTable extends Migration
{
    public function up()
    {
        Schema::create('kompen', function (Blueprint $table) {
            $table->id('id_kompen');
            $table->string('nomor_kompen', 36)->unique();
            $table->string('nama', 40);
            $table->string('deskripsi', 255);
            $table->foreignId('id_personil')->constrained('personil_akademik');
            $table->foreignId('id_jenis_kompen')->constrained('jenis_kompen');
            $table->integer('kuota');
            $table->integer('jam_kompen');
            $table->boolean('status');
            $table->boolean('is_selesai');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kompen');
    }
}
