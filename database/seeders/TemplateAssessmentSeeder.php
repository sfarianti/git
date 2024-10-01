<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TemplateAssessmentPoint;

class TemplateAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TemplateAssessmentPoint::create(
        [
            'point' => 'Penetapan Aktivitas',
            'detail_point' => '',
            'pdca' => 'Plan',
            'score_max' => '80',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Proses Pemecahan Masalah & Perbaikan',
            'detail_point' => '',
            'pdca' => 'Plan',
            'score_max' => '80',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Solusi',
            'detail_point' => '',
            'pdca' => 'Plan',
            'score_max' => '100',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Tingkat Kesulitan',
            'detail_point' => '',
            'pdca' => 'Do',
            'score_max' => '120',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Mutu Proses Pelaksanaan',
            'detail_point' => '',
            'pdca' => 'Do',
            'score_max' => '80',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Ketepatan & Kelengkapan Evaluasi',
            'detail_point' => '',
            'pdca' => 'Check',
            'score_max' => '80',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Dampak Hasil',
            'detail_point' => '',
            'pdca' => 'Check',
            'score_max' => '220',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Standarisasi',
            'detail_point' => '',
            'pdca' => 'Action',
            'score_max' => '80',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Mutu Makalah',
            'detail_point' => '',
            'pdca' => 'Action',
            'score_max' => '80',
            'category' => 'BI/II',
        ]);
        TemplateAssessmentPoint::create(
        [
            'point' => 'Mutu Presentasi',
            'detail_point' => '',
            'pdca' => 'Action',
            'score_max' => '80',
            'category' => 'BI/II',
        ]);
    }
}
