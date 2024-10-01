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
        Schema::table('pvt_assessment_events', function (Blueprint $table) {
            //
            $table->string('point')->nullable();
            $table->text('detail_point')->nullable();
            $table->enum('pdca', ['Plan', 'Check', 'Do', 'Action'])->nullable();
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
        Schema::table('pvt_assessment_events', function (Blueprint $table) {
            //
            
        });
    }
};
