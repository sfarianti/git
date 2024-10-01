<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiChartController extends Controller
{
    public function chartData()
    {
        $dataBar = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            'datasets' => [
                [
                    'label' => 'Sample Data',
                    'data' => [100, 20, 15, 25, 30],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
        $dataHBar = [
            'labels' => ['PT Semen Indonesia Group', 'PT Semen Gresik', 'PT Semen Tonasa', 'PT Semen Baturaja', 'PT Semen Padang','PT Solusi Bangun Indonesia'],
            'datasets' => [
                [
                    'label' => 'Benefit Perusahaan (dalam miliar)',
                    'data' => [110, 50, 78, 65, 59,49],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
        ];
        $dataLine = [
            'labels' => ['PT Semen Indonesia Group', 'PT Semen Gresik', 'PT Semen Tonasa', 'PT Semen Baturaja', 'PT Semen Padang','PT Solusi Bangun Indonesia'],
            'datasets' => [
                [
                    'label' => 'Benefit Perusahaan (dalam miliar)',
                    'data' => [110, 50, 78, 65, 59,49],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
        ];
        $dataPie = [
            'labels' => ['SIG', 'SMGR', 'SMTNS', 'SMBR', 'SMPD','SMCB'],
            'datasets' => [
                [
                    'label' => 'Benefit Perusahaan (dalam miliar)',
                    'data' => [110, 50, 78, 65, 59,49],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                ],
            ],
        ];

        return response()->json([
            'dataBar' => $dataBar,
            'dataHBar' => $dataHBar,
            'dataLine' => $dataLine,
            'dataPie' => $dataPie
        ]);
    }
}
