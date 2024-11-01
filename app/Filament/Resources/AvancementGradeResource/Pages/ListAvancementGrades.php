<?php

namespace App\Filament\Resources\AvancementGradeResource\Pages;

use App\Filament\Resources\AvancementGradeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAvancementGrades extends ListRecords
{
    protected static string $resource = AvancementGradeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
