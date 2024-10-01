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
        Schema::create('pvt_assesment_team_judges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('judge_id');
            $table->foreign('judge_id')->references('id')->on('judges')->onDelete('cascade');
            $table->unsignedBigInteger('assessment_team_id');
            $table->foreign('assessment_team_id')->references('id')->on('pvt_assessment_teams')->onDelete('cascade');
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
        Schema::dropIfExists('pvt_assesment_team_judges');
    }
};
