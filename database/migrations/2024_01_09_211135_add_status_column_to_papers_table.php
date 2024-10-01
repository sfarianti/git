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
            //
            Schema::table('papers', function (Blueprint $table) {
            $table->enum('status', [
                'not finish',
                'not accepted', 
                'accepted by facilitator', 
                'rejected by facilitator',  
                'accepted by innovation admin', 
                'rejected by innovation admin',
                'rollback',
            ])->default('not finish');
        });
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
            //
        });
    }
};
