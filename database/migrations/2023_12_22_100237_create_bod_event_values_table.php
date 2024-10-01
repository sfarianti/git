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
        Schema::create('bod_event_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_team_id');
            $table->foreign('event_team_id')->references('id')->on('pvt_event_teams')->onDelete('cascade');
            $table->integer('value');
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
        Schema::dropIfExists('bod_event_values');
    }
};
