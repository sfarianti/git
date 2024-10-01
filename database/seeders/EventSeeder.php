<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Event::create(
        [
            'event_name' => 'SIG IA 2000 & 7000',
            'description' => '',
            'company_code' => '2000'
        ]);
        Event::create(
        [
            'event_name' => 'SIG IA 2000 & 7000',
            'description' => '',
            'company_code' => '7000'
        ]);
        Event::create(
        [
            'event_name' => 'SIG IA 3000',
            'description' => '',
            'company_code' => '3000'
        ]);
        Event::create(
        [
            'event_name' => 'SIG IA 4000',
            'description' => '',
            'company_code' => '4000'
        ]);
        Event::create(
        [
            'event_name' => 'SIG IA 5000',
            'description' => '',
            'company_code' => '5000'
        ]);
        Event::create(
        [
            'event_name' => 'SIG IA 9000',
            'description' => '',
            'company_code' => '9000'
        ]);
        Event::create(
        [
            'event_name' => 'SIG IA SBI',
            'description' => '',
            'company_code' => 'SBI'
        ]);
        Event::create(
        [
            'event_name' => 'SIGGIA',
            'description' => '',
            'company_code' => '2000, 7000'
        ]);
    }
}
