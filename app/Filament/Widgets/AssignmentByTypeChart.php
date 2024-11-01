<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\User;
use App\Models\Sexe;
use App\Models\AssignmentDetail;
use App\Models\Assignment;

class AssignmentByTypeChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'assignmentByTypeChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Affectation Central';
    protected static ?int $sort = 5;
    
    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
      

    protected function getOptions(): array
    { 
        $direction = AssignmentDetail::countUserByAssignmentCent(100,199);
        $poleAffaireJuridique = AssignmentDetail::countUserByAssignmentCent(200,299);
        $poleSureveillance = AssignmentDetail::countUserByAssignmentCent(300,399);
        $poleInformatique = AssignmentDetail::countUserByAssignmentCent(400,499);
        $poleSecuritéConduite = AssignmentDetail::countUserByAssignmentCent(500,599);
        $poleCommunication = AssignmentDetail::countUserByAssignmentCent(600,699);
        $poleAudit = AssignmentDetail::countUserByAssignmentCent(700,799);

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            
            'series' => [
                [
                    'name' => 'Le Total par Pôle',
                    'data' => [$direction ,  $poleAffaireJuridique ,  $poleSureveillance , $poleInformatique ,  $poleSecuritéConduite, $poleCommunication, $poleAudit ],
                ],
            ],
            'xaxis' => [
                'categories' => ['Direction de L\'Agence Nationale de la Sécurité Routière' , 
                                 'Pôle Affaires Administratives, Juridiques et Financières',
                                 'Pôle Surveillance et Expertise en Sécurité Routière',
                                 'Pôle Systèmes d\'Information et Nouvelles Technologies de  la Sécurité Routière',
                                 'Pôle Sécurité de la Conduite et des Véhicules',
                                 'Pôle Communication, Education et Prévention Routière',
                                 'Pôle  Qualité, Audit et Contrôle de Gestion',
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
