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
        Schema::table('pvt_assesment_team_judges', function (Blueprint $table) {
            $table->dropForeign(['assessment_team_id']);
            $table->dropColumn('assessment_team_id');
        });

        Schema::table('pvt_assesment_team_judges', function (Blueprint $table) {
            $table->unsignedBigInteger('event_team_id');
            $table->foreign('event_team_id')->references('id')->on('pvt_event_teams');
            $table->unsignedBigInteger('assessment_event_id');
            $table->foreign('assessment_event_id')->references('id')->on('pvt_assessment_events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pvt_assesment_team_judges', function (Blueprint $table) {
            //
        });
    }
};
