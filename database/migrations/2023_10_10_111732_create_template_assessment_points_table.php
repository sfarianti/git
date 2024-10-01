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
        Schema::create('template_assessment_points', function (Blueprint $table) {
            $table->id();
            $table->string('point')->nullable();
            $table->text('detail_point')->nullable();
            $table->enum('pdca', ['Plan', 'Check', 'Do', 'Action'])->nullable();
            $table->integer('score_max')->nullable();
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
        Schema::dropIfExists('template_assessment_points');
    }
};
