<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\User;
use App\Models\Sexe;
use App\Models\AssignmentDetail;
use App\Models\Assignment;

class AgePyramid extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'agePyramid';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Pyramid des Ages';
    protected static ?int $sort = 7;
    protected int | string | array $columnSpan = 'full';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        
        $ageH = User::countByAgeHomme();
        $ageF = User::countByAgeFemme();
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
                'borderRadius' => 0,
                'barHeight' => '80%',
            ],
            'series' => [
                
                    [
                    'name' => 'Homme',
                    'group'=> 'Homme',
                    'data' => [$ageH[0] , $ageH[1] , $ageH[2] ,$ageH[3] ,$ageH[4] , $ageH[5] ,$ageH[6] ,$ageH[7] ,$ageH[8]],
                    ],
                    [
                    'name' => 'Femme',
                    'group'=> 'Homme',
                    'data' => [$ageF[0] , $ageF[1] , $ageF[2] ,$ageF[3] ,$ageF[4] , $ageF[5] ,$ageF[6] ,$ageF[7] ,$ageF[8]],
                    ],
                
            ],
            'xaxis' => [
                'categories' => ['moins de 25 ans' , '26 - 30' , '31 - 35' , '36 - 40' , '41 - 45' , '46 - 50' , '51 - 55', '56 - 60' , 'plus de 60 ans'],
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#6366f1' , '#FCAEAE'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                    'barHeight'=> '80%',
                ],
            ],
        ];
    }
}
