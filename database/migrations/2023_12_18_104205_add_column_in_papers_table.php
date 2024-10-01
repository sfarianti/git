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
        Schema::table('papers', function (Blueprint $table) {
            $table->LongText('problem')->nullable();
            $table->LongText('problem_impact')->nullable();
            $table->LongText('main_cause')->nullable();
            $table->LongText('solution')->nullable();
            $table->LongText('outcome')->nullable();
            $table->LongText('performance')->nullable();
            $table->string('innovation_photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('papers', function (Blueprint $table) {
            //
        });
    }
};
