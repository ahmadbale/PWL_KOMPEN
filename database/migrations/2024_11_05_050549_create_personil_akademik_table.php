<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonilAkademikTable extends Migration
{
    public function up()
    {
        Schema::create('personil_akademik', function (Blueprint $table) {
            $table->id('id_personil');
            $table->string('nomor_induk', 18)->unique();
            $table->string('username', 20);
            $table->string('nama', 255);
            $table->string('password', 255);
            $table->char('nomor_telp', 15);
            $table->integer('id_level');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personil_akademik');
    }
}
