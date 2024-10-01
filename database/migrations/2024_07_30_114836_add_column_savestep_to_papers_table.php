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
            $table->string('step_1_initial')->nullable();
            $table->string('step_2_initial')->nullable();
            $table->string('step_3_initial')->nullable();
            $table->string('step_4_initial')->nullable();
            $table->string('step_5_initial')->nullable();
            $table->string('step_6_initial')->nullable();
            $table->string('step_7_initial')->nullable();
            $table->string('step_8_initial')->nullable();
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
            $table->dropColumn('step_1_initial');
            $table->dropColumn('step_2_initial');
            $table->dropColumn('step_3_initial');
            $table->dropColumn('step_4_initial');
            $table->dropColumn('step_5_initial');
            $table->dropColumn('step_6_initial');
            $table->dropColumn('step_7_initial');
            $table->dropColumn('step_8_initial');
        });
    }
};
