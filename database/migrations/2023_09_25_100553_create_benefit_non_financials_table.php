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
        Schema::create('benefit_non_financials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_benefit_nonfin');
            $table->unsignedBigInteger('paper_id');
            $table->foreign('paper_id')->references('id')->on('papers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benefit_non_financials');
    }
};
