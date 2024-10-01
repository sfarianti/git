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
        Schema::create('document_supportings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paper_id');
            $table->foreign('paper_id')->references('id')->on('papers')->onDelete('cascade');
            $table->string('file_name');
            $table->string('path');
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
        Schema::dropIfExists('document_supportings');
    }
};
