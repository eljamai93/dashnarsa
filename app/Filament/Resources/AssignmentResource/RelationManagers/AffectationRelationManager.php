<?php

namespace App\Filament\Resources\AssignmentResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Assignment;

class AffectationRelationManager extends RelationManager
{
    protected static string $relationship = 'Affectation';

    protected static ?string $recordTitleAttribute = 'designationFr';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('assignment_id')
                ->label('Affectation')
                ->options(Assignment::all()->pluck('designationFr', 'id'))
                ->searchable(),
                Forms\Components\DatePicker::make('assignmentSeniority')
                ->required()->format('d/m/Y'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('designationFr')->label('Designation'),
                Tables\Columns\TextColumn::make('assignmentSeniority')->date('d-m-Y')->label('Date d\'Affectation'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
