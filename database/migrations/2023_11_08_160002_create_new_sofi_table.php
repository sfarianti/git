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
        Schema::create('new_sofi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_team_id');
            $table->foreign('event_team_id')->references('id')->on('pvt_event_teams');
            $table->text('strength')->nullable();
            $table->text('opportunity_for_improvement')->nullable();
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
        Schema::dropIfExists('new_sofi');
    }
};
