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
        Schema::table('pvt_event_teams', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('pvt_event_teams', function (Blueprint $table) {
            $table->enum('status', ['On Desk', 'Presentation', 'tidak lolos On Desk', 'tidak lolos Presentation', 'Lolos Presentation', 'Tidak lolos Caucus', 'Caucus', ])->default('On Desk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pvt_event_teams', function (Blueprint $table) {
            //
        });
    }
};
