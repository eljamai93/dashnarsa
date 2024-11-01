<?php

namespace App\Filament\Resources\AvancementGradeResource\Pages;

use App\Filament\Resources\AvancementGradeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAvancementGrade extends EditRecord
{
    protected static string $resource = AvancementGradeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
