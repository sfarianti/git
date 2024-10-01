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
        Schema::create('papers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('innovation_title');
            $table->LongText('step_1')->nullable();
            $table->LongText('step_2')->nullable();
            $table->LongText('step_3')->nullable();
            $table->LongText('step_4')->nullable();
            $table->LongText('step_5')->nullable();
            $table->LongText('step_6')->nullable();
            $table->LongText('step_7')->nullable();
            $table->LongText('step_8')->nullable();
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('papers');
    }
};
