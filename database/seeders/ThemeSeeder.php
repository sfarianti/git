<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Theme::create(
        [
            'theme_name' => 'OPERATIONAL EXCELLENCY',
        ]);
        Theme::create(
        [
            'theme_name' => 'EMISI (CO2, DEBU, AIR, DLL)',
        ]);
        Theme::create(
        [
            'theme_name' => 'ENERGY MANAGEMENT',
        ]);
        Theme::create(
        [
            'theme_name' => 'COST REDUCTION',
        ]);
        Theme::create(
        [
            'theme_name' => 'SAFETY, HEALTH & ENVIRONTMENT',
        ]);
        Theme::create(
        [
            'theme_name' => 'DIGITALIZATION',
        ]);
         Theme::create(
        [
            'theme_name' => 'MARKETING DOMINANCY',
        ]);
         Theme::create(
        [
            'theme_name' => 'PENGEMBANGAN PRODUK & TEKHNOLOGY',
        ]);
    }
}
