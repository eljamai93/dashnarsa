<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;

class EmployeeCount extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getCards(): array
    {
        $users = new User;
        return [
            Card::make('Fonctionnaire', $users->UsersCount())
            ->description('le nombre total de fonctionnaires en poste')
            ->descriptionIcon('heroicon-s-trending-up'),

            Card::make('Central', User::getAssignmentCentralCount())
            ->description('le nombre total de fonctionnaires en poste au central')
            ->descriptionIcon('heroicon-s-trending-up'),

            Card::make('Extérieur', User::getAssignmentextErnalCount())
            ->description('le nombre total de fonctionnaires en poste a l\'extérieur')
            ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
