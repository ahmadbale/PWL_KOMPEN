<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrKodeTable extends Migration
{
    public function up()
    {
        Schema::create('qr_kode', function (Blueprint $table) {
            $table->id('id_qr_kode');
            $table->foreignId('id_kompen')->constrained('kompen');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa');
            $table->string('qr_pemberi_tugas', 26);
            $table->dateTime('tanggal_qr_pemberi_tugas');
            $table->string('qr_pelinggi_jurusan', 26);
            $table->dateTime('tanggal_qr_pelinggi_jurusan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qr_kode');
    }
}