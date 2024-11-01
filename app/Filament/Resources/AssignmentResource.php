<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentResource\Pages;
use App\Filament\Resources\AssignmentResource\RelationManagers;
use App\Models\Assignment;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class AssignmentResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Espace Fonctionnaire';

    protected static ?string $slug = 'Affectation';

    protected static ?string $modelLabel = 'Affectation';

    protected static ?string $navigationLabel = 'Affectation';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Fonctionnaire')
                ->description('information sur le fonctionnaire')
                ->schema([
                Forms\Components\TextInput::make('matricule')->label(__('Matricule')),
                Forms\Components\TextInput::make('cin')->label(__('Cin')),
                Forms\Components\TextInput::make('lasteName_fr')->label(__('Nom')),
                Forms\Components\TextInput::make('firstName_fr')->label(__('Prénom'))
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('matricule')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('cin')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lasteName_fr')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('firstName_fr')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('Affectation.designationFr')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('Affectation.pertaining')->label(__('Type D\'affectation'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('getAssignmentSeniority.assignmentSeniority')->date('d-m-Y')->label(__('Date d\'Affectation'))

            ])
            ->filters([

                SelectFilter::make('status')
                    ->options([
                    'S.Exterieurs' => 'S.Exterieurs',
                    'S.Centraux' => 'S.Centraux',
                ])->attribute('Affectation.pertaining')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\AffectationRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignment::route('/create'),
            'edit' => Pages\EditAssignment::route('/{record}/edit'),
        ];
       
    }    
}
