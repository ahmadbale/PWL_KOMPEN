<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileImageToMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::table('m_user', function (Blueprint $table) {
            $table->string('profile_image')->nullable()->after('password'); // Menambahkan kolom profile_image
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_user', function (Blueprint $table) {
            $table->dropColumn('profile_image'); // Menghapus kolom profile_image saat rollback
        });
    }
}