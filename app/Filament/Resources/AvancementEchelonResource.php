<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AvancementEchelonResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\AvancementEchelon;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\RelationManagers\RelationGroup;
use App\Models\Sexe;
use App\Models\Echelon;


class AvancementEchelonResource extends Resource
{
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Espace Fonctionnaire';

    protected static ?string $slug = 'Avancement d\'Echelon';

    protected static ?string $modelLabel = 'Avancement d\'Echelon';

    protected static ?string $navigationLabel = 'Avancement d\'Echelon';

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Fonctionnaire')
                ->description('Informations sur le Fonctionnaire')
                ->schema([
                Forms\Components\Grid::make(3)
                   ->schema([
                   Forms\Components\TextInput::make('matricule')->label(__('Matricule')),
                   Forms\Components\TextInput::make('cin')->label(__('Cin')),
                   Forms\Components\DatePicker::make('recrutementDate')->label(__('Date de Recrutement')),
                   
                   ]),
                Forms\Components\TextInput::make('lasteName_fr')->label(__('Nom')),
                Forms\Components\TextInput::make('firstName_fr')->label(__('Prénom')),
                Forms\Components\TextInput::make('lasteName_ar')->label(__('الأسم العائلي')),
                Forms\Components\TextInput::make('firstName_ar')->label(__('الأسم الشخصي')),
                Forms\Components\Select::make('id_sexe')
                ->label('Sexe')
                ->options(Sexe::all()->pluck('sexe', 'id')),
                Forms\Components\TextInput::make('phoneNumber')->label(__('Mobile')),
                Forms\Components\DatePicker::make('dateBirth')->label(__('Date de Naissance')),
                Forms\Components\TextInput::make('placeBirth')->label(__('Lieu de Naissance')),
                
                Forms\Components\Grid::make(7)
                ->schema([
                Forms\Components\TextInput::make('zipCode')->label(__('Code Postal'))->columnSpan(1),
                Forms\Components\TextInput::make('city')->label(__('Ville'))->columnSpan(2),
                Forms\Components\TextInput::make('address')->label(__('Adresse'))->columnSpan(4),
                ])
                
                ])->collapsible()
               ->columns(2),
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
                Tables\Columns\TextColumn::make('Echelon_Actuelle.echelon')->label(__('Echelon')),
                Tables\Columns\TextColumn::make('getechelonSeniority.echelonSeniority')->date('d-m-Y')->label(__('Date d\'Echelon'))
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
            RelationManagers\EchelonRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAvancementEchelons::route('/'),
            'create' => Pages\CreateAvancementEchelon::route('/create'),
            'edit' => Pages\EditAvancementEchelon::route('/{record}/edit'),
        ];
    }    
}