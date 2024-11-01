<?php

namespace App\Filament\Resources\AvancementEchelonResource\Pages;

use App\Filament\Resources\AvancementEchelonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAvancementEchelons extends ListRecords
{
    protected static string $resource = AvancementEchelonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
