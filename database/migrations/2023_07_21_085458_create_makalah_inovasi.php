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
        Schema::create('makalah_inovasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tim');
            $table->string('nama_ketua');
            $table->enum('nama_perusahaan', ['PT Semen Indonesia Tbk.', 'PT Solusi Bangun Indonesia Tbk.', 'PT Semen Baturaja Tbk', 'PT Semen Tonasa', 'PT Semen Gresik', 'PT Semen Padang']);
            $table->string('judul_inovasi');
            $table->enum('event', ['SIG IA 2000 dan 7000', 'SIGGIA', 'TKMPN', 'International']);
            $table->enum('kategori', ['Produk dan Bahan Baku', 'Teknologi dan Proses Produksi','Manajemen', 'GKM Plant', 'GKM Office','PKM Plant','PKM Office','SS Plant','SS Office','Idea']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('makalah_inovasi');
    }
};
