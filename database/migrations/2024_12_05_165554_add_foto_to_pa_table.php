<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('personil_akademik', function (Blueprint $table) {
            $table->string('image')->nullable()->after('nomor_telp'); // Menambahkan kolom profile_image
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personil_akademik', function (Blueprint $table) {
            $table->dropColumn('image'); 
        });
    }
};