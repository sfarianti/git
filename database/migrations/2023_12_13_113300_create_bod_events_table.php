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
        Schema::create('bod_events', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->enum('category', ['Rekomendasi', 'Keputusan'])->nullable();
            $table->enum('status', ['active', 'nonactive'])->default('active');
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
        Schema::dropIfExists('bod_events');
    }
};
