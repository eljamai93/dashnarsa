<?php

namespace App\Filament\Widgets;
use App\Models\User;
use App\Models\Grade;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class GradeChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'gradeChart';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Grade';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $CountByGrades = Grade::countUserByGrade();
        $GradeNames = Grade::allgrade();
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 800,
            ],
            'series' => [
                [
                    'name' => 'Le Total par Grade',
                    'data' => $CountByGrades,
                ],
            ],
            'xaxis' => [
                'categories' => $GradeNames,
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 300,
                        'fontSize' => 10,
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
            'colors' => ['#6366f1'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 1,
                    'horizontal' => true,
                ],
            ],
            
        ];
    }
}
