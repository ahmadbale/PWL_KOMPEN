<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetensiTable extends Migration
{
    public function up()
    {
        Schema::create('kompetensi', function (Blueprint $table) {
            $table->id('id_kompetensi');
            $table->string('nama_kompetensi', 30);
            $table->string('deskripsi_kompetensi', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kompetensi');
    }
}
