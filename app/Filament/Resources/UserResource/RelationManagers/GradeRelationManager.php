<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Grade;

class GradeRelationManager extends RelationManager
{
    protected static string $relationship = 'Grade_Actuelle';

    protected static ?string $recordTitleAttribute = 'grade';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('grade_id')
                ->label('Grade')
                ->options(Grade::all()->pluck('gradeFr', 'id'))
                ->searchable(),
                Forms\Components\DatePicker::make('gradeSeniority')
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gradeFr')->label('Grade'),
                Tables\Columns\TextColumn::make('gradeAr')->label('الدرجة'),
                Tables\Columns\TextColumn::make('gradeSeniority')->label('Date de Grade'),
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
