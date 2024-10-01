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
        //
        Schema::table('new_sofi', function (Blueprint $table) {
            $table->dropColumn('real_benefit');
            $table->dropColumn('potential_benefit');
            $table->dropColumn('potensi_replikasi');
            $table->decimal('real_benefit')->nullable();
            $table->decimal('potential_benefit')->nullable();
            $table->enum('potensi_replikasi', ['Bisa Direplikasi', 'Tidak Bisa Direplikasi'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
