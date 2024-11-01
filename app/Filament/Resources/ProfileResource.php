<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Profile;
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

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Espace Fonctionnaire';

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
                Tables\Columns\TextColumn::make('getechelonSeniority.echelonSeniority')->date('d-m-Y')->label(__('Date d\'Echelon')),
                Tables\Columns\TextColumn::make('Grade_Actuelle.gradeFr')->label(__('Grade')),
                Tables\Columns\TextColumn::make('getgradeSeniority.gradeSeniority')->date('d-m-Y')->label(__('Date de Grade'))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
           
            RelationGroup::make('Contacts', [
              
                RelationManagers\GradeRelationManager::class,
                RelationManagers\EchelonRelationManager::class,
                ]),
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }    
}
