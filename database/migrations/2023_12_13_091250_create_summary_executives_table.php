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
        Schema::create('summary_executives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pvt_event_teams_id');
            $table->foreign('pvt_event_teams_id')->references('id')->on('pvt_event_teams')->onDelete('cascade');
            $table->text('problem_background')->nullable();
            $table->text('innovation_idea')->nullable();
            $table->text('benefit')->nullable();
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
        Schema::dropIfExists('summary_executives');
    }
};
