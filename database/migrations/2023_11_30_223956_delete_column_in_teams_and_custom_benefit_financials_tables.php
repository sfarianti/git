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
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
        });
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('event_id');
        });

        Schema::table('custom_benefit_financials', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
        });
        Schema::table('custom_benefit_financials', function (Blueprint $table) {
            $table->dropColumn('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams_and_custom_benefit_financials_tables', function (Blueprint $table) {
            //
        });
    }
};
