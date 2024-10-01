<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin::create(
        //     [
        //         'name' => 'Superadmin',
        //         'username' => 'superadmin',
        //         'password' => Hash::make('testsuperadmin'),
        //         'email' => 'super@admin.com',
        //         'role' => 'Superadmin'
        //     ]);
        // Admin::create(
        //     [
        //         'name' => 'Admin',
        //         'username' => 'admin',
        //         'password' => Hash::make('testadmin'),
        //         'email' => 'admin@admin.com',
        //         'role' => 'Admin'
        //     ]);
        // User::create(
        //     [
        //         'name' => 'Superadmin',
        //         'employee_id' => '0',
        //         'position_title' => '0',
        //         'company_name' => '0',
        //         'directorate_name' => '0',
        //         'group_function_name' => '0',
        //         'departement_name' => 'SIGIA',
        //         'unit_name' => '0',
        //         'section_name' => '0',
        //         'sub_section_of' => '0',
        //         'date_of_birth' => '0',
        //         'gender' => '0',
        //         'job_level' => '0',
        //         'contract_type' => '0',
        //         'home_company' => '0',
        //         'manager_id' => '0',
        //         'username' => 'superadmin',
        //         'password' => Hash::make('testsuperadmin'),
        //         'email' => 'super@admin.com',
        //         'role' => 'Superadmin'
        //     ]);

            User::create(
                [
                    'name' => 'superadmin',
                    'employee_id' => '3',
                    'position_title' => '0',
                    'company_name' => '0',
                    'directorate_name' => '0',
                    'group_function_name' => '0',
                    'department_name' => 'SIGIA',
                    'unit_name' => '0',
                    'section_name' => '0',
                    'sub_section_of' => '0',
                    'date_of_birth' => '0',
                    'gender' => '0',
                    'job_level' => '0',
                    'contract_type' => '0',
                    'home_company' => '0',
                    'manager_id' => '2',
                    'username' => 'admin@gmail.com',
                    'password' => Hash::make('testadmin'),
                    'email' => 'admin@gmail.com',
                    'role' => 'Admin'
                ]);
        // Admin::create(
        //     [
        //         'name' => 'Admin',
        //         'username' => 'admin',
        //         'password' => Hash::make('testadmin'),
        //         'email' => 'admin@admin.com',
        //         'role' => 'Admin'
        //     ]);
    }
}
