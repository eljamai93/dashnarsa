<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Echelon;

class EchelonRelationManager extends RelationManager
{
    protected static string $relationship = 'Echelon_Actuelle';

    protected static ?string $recordTitleAttribute = 'echelon';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
             
                Forms\Components\Select::make('echelon_id')
                ->label('Echelon')
                ->options(Echelon::all()->pluck('name', 'id'))
                ->searchable(),
                Forms\Components\DatePicker::make('echelonSeniority')
                ->required()->format('d/m/Y')
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('echelon')->label('Echelon'),
                Tables\Columns\TextColumn::make('echelonSeniority')->date('d-m-Y')->label('Date d\'Echelon'),
                Tables\Columns\TextColumn::make('updated_at')->label('Date de Modification')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                
            ])
            ->actions([
               
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                
            ]);
    }
    protected function isTablePaginationEnabled(): bool 
    {
        return false;
    }     
}
