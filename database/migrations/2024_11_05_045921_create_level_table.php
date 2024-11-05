<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTable extends Migration
{
    public function up()
    {
        Schema::create('level', function (Blueprint $table) {
            $table->id('id_level');
            $table->string('kode_level', 10)->unique();
            $table->string('nama_level', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('level');
    }
}