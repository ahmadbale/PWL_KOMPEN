<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisKompenTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_kompen', function (Blueprint $table) {
            $table->id('id_jenis_kompen');
            $table->string('kode_jenis', 10)->unique();
            $table->string('nama_jenis', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_kompen');
    }
}
