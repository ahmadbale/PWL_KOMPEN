<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompenDetailTable extends Migration
{
    public function up()
    {
        Schema::create('kompen_detail', function (Blueprint $table) {
            $table->id('id_kompen_detail');
            $table->foreignId('id_kompen')->constrained('kompen');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa');
            $table->string('progres_1', 255);
            $table->string('progres_2', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kompen_detail');
    }
}