<?php

namespace App\Filament\Resources\AvancementEchelonResource\Pages;

use App\Filament\Resources\AvancementEchelonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAvancementEchelon extends EditRecord
{
    protected static string $resource = AvancementEchelonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
