<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\User;
use App\Models\Sexe;
use App\Models\AssignmentDetail;
use App\Models\Assignment;

class RegionalChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'regionalChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Affectation Regional';
    protected static ?int $sort = 6;
    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $RegionTanger = AssignmentDetail::countUserByAssignmentReg(1000,1999);
        $RegionOrion = AssignmentDetail::countUserByAssignmentReg(2000,2999);
        $RegionFes = AssignmentDetail::countUserByAssignmentReg(3000,3999);
        $RegionRabat = AssignmentDetail::countUserByAssignmentReg(4000,4999);
        $RegionBnimenlala = AssignmentDetail::countUserByAssignmentReg(5000,5999);
        $RegionCasablanca = AssignmentDetail::countUserByAssignmentReg(6000,6999);
        $RegionMarakech = AssignmentDetail::countUserByAssignmentReg(7000,7999);
        $RegionDaraa = AssignmentDetail::countUserByAssignmentReg(8000,8999);
        $RegionSousMassa = AssignmentDetail::countUserByAssignmentReg(9000,9999);
        $RegionLaayoun = AssignmentDetail::countUserByAssignmentReg(10000,10010);

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Le Total par Direction',
                    'data' => [$RegionTanger, $RegionOrion, $RegionFes, $RegionRabat, $RegionBnimenlala,
                               $RegionCasablanca, $RegionMarakech, $RegionDaraa, $RegionSousMassa,  $RegionLaayoun 
                              ],
                ],
            ],
            'xaxis' => [
                'categories' => ['Direction Régionale de Tanger - Tétouan - Al-Hoceima', 'Direction Régionale de l\'Oriental ', 'Direction Régionale de Fès - Méknès '
                                 , 'Direction Régionale de Rabat - Salé - Kénitra ', 'Direction Régionale de Beni Mellal - Khénifra ', 'Direction Régionale de Casablanca - Settat'
                                 , 'Direction Régionale de Marrakech - Safi', 'Direction Régionale de Daraa - Tafilalet', 'Direction Régionale de Souss - Massa - Guelmim - Oued Noun'
                                 ,'Direction Régionale de Laayoune - Saqiya El Hamra- Dakhla - Oued Dahab ', 
                                
                                ],
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
            'colors' => ['#6366f1'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => true,
                ],
            ],
        ];
    }
}
