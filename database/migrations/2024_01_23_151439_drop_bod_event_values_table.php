<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            // Menambahkan kolom inovasi_lokasi dengan izin nilai null
            $table->string('inovasi_lokasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('papers', function (Blueprint $table) {
            // Menghapus kolom inovasi_lokasi
            $table->dropColumn('inovasi_lokasi');
        });
    }
};
