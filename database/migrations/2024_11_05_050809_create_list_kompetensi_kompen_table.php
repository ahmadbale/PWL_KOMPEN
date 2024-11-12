<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListKompetensiKompenTable extends Migration
{
    public function up()
    {
        Schema::create('list_kompetensi_kompen', function (Blueprint $table) {
            $table->id('id_list_kompetensi_kompen');
            $table->foreignId('id_kompen')->constrained('kompen');
            $table->foreignId('id_kompetensi')->constrained('kompetensi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('list_kompetensi_kompen');
    }
}

