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
        Schema::table('template_assessment_points', function (Blueprint $table) {
            //
            $table->enum('category', ['IDEA', 'BI/II'])->before('score_max')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_assessment_points', function (Blueprint $table) {
            //
        });
    }
};
