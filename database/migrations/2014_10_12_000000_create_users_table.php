<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('uuid')->default(DB::raw('public.uuid_generate_v4()'));
            $table->string('employee_id')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('position_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('directorate_name')->nullable();
            $table->string('group_function_name')->nullable();
            $table->string('department_name')->nullable();
            $table->string('unit_name')->nullable();
            $table->string('section_name')->nullable();
            $table->string('sub_section_of')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('job_level') -> nullable();
            $table->string('contract_type')->nullable();
            $table->string('home_company')->nullable();
            $table->string('manager_id')->nullable();
            // $table->enum('kode_perusahaan',['2000','2200','2300','2720','3000','4000','5000','7000','G210','SBI']) -> nullable();
            $table->enum('role',['Superadmin','Admin','Pengelola Inovasi','BOD','5', 'User']) -> nullable();
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
        Schema::dropIfExists('users');
    }
};