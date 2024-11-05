<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanKompenTable extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_kompen', function (Blueprint $table) {
            $table->id('id_pengajuan_kompen');
            $table->foreignId('id_kompen')->constrained('kompen');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa');
            $table->enum('status', ['pending', 'acc', 'reject']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_kompen');
    }
}
