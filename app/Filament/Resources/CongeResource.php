<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CongeResource\Pages;
use App\Filament\Resources\CongeResource\RelationManagers;
use App\Models\Conge;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Get;
use Filament\Forms\Components\Select;
use Illuminate\Support\Collection;

class CongeResource extends Resource
{
    protected static ?string $model = Conge::class;

    protected static ?string $navigationGroup = 'les Congés';

    protected static ?string $navigationLabel = 'Congés Administratifs';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form;
            
                // Forms\Components\Select::make('getuserinfos.matricule')
                //  ->getSearchResultsUsing(fn (string $search): array => User::where('matricule', 'like', "%{$search}%")->limit(50)->pluck('lasteName_fr', 'matricule')->toArray())
                // //  ->getSearchResultsUsing(fn (string $search): array => User::where('lasteName_fr', 'like', "%{$search}%")->limit(50)->pluck('lasteName_fr', 'matricule')->toArray())
                // //  ->getSearchResultsUsing(fn (string $search): array => User::where('cin', 'like', "%{$search}%")->limit(50)->pluck('lasteName_fr', 'matricule')->toArray())
                //  ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->matricule)
                //  ->live()
                //  ->label(__('Fonctionnaire'))
                //  ->searchable(),
               

                 
                
             
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('getuserinfos.matricule')->searchable()->sortable()->label(__('matricule')),
                Tables\Columns\TextColumn::make('getuserinfos.lasteName_fr')->searchable()->sortable()->label(__('Nom')),
                Tables\Columns\TextColumn::make('getuserinfos.firstName_fr')->searchable()->sortable()->label(__('Prenom')),
                Tables\Columns\TextColumn::make('dateDebu')->searchable()->sortable()->label(__('Date de Début')),
                Tables\Columns\TextColumn::make('dateFin')->searchable()->sortable()->label(__('Date de Fin')),
                Tables\Columns\TextColumn::make('nbrJour')->searchable()->sortable()->label(__('durée de congé')),
                Tables\Columns\TextColumn::make('solde')->searchable()->sortable()->label(__('le solde du congé')),
                Tables\Columns\TextColumn::make('soldeAnnee')->searchable()->sortable()->label(__('l\'année du solde')),
           
            ])
            ->filters([
                //
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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConges::route('/'),
            'create' => Pages\CreateConge::route('/create'),
            'edit' => Pages\EditConge::route('/{record}/edit'),
        ];
    }    
}
