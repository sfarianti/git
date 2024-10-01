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
        Schema::table('pvt_members', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('pvt_members', function (Blueprint $table) {
            $table->enum('status', ['member', 'leader', 'facilitator', 'gm'])->default('member');
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pvt_members', function (Blueprint $table) {
            //
        });
    }
};
