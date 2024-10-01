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
        Schema::create('pvt_assessment_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_team_id');
            $table->foreign('event_team_id')->references('id')->on('pvt_event_teams');
            $table->unsignedBigInteger('assessment_event_id');
            $table->foreign('assessment_event_id')->references('id')->on('pvt_assessment_events');
            $table->integer('score')->nullable();
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
        Schema::dropIfExists('pvt_assessment_teams');
    }
};
