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
        Schema::table('summary_ppts', function (Blueprint $table) {
            //
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            //add foreign key

            $table->unsignedBigInteger('pvt_event_teams_id')->nullable();
            $table->foreign('pvt_event_teams_id')->references('id')->on('pvt_event_teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('summary_ppts', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }
};
