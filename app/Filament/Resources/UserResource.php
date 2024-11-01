<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\Sexe;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\RelationManagers\RelationGroup;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Filters\Filter;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Espace Fonctionnaire';

    protected static ?string $slug = 'Biographie_Fonctionnaires';

    protected static ?string $modelLabel = 'Biographie des Fonctionnaires';

    protected static ?string $navigationLabel = 'Biographie';

    protected static ?string $navigationIcon = 'heroicon-o-identification';

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
            Forms\Components\Grid::make(3)
               ->schema([
               Forms\Components\TextInput::make('email')->label(__('Email')),
               Forms\Components\TextInput::make('password')
               ->password()
               ->dehydrateStateUsing(fn ($state) => Hash::make($state))
               ->dehydrated(fn ($state) => filled($state))
               ->required(fn (string $context): bool => $context === 'create'),
               Forms\Components\Select::make('roles')
               ->relationship('roles', 'name')
               ->multiple(),
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
            
            ])
           ->columns(2),
        ]);
        
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matricule')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('cin')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lasteName_fr')->searchable()->sortable()->label(__('Nom de Famille')),
                Tables\Columns\TextColumn::make('firstName_fr')->searchable()->sortable()->label(__('Prénom')),
                Tables\Columns\TextColumn::make('lasteName_ar')->searchable()->sortable()->label(__('الأسم العائلي')),
                Tables\Columns\TextColumn::make('firstName_ar')->searchable()->sortable()->label(__('الأسم الشخصي')),
                Tables\Columns\TextColumn::make('dateBirth')->searchable()->sortable()->label(__('Date de Naissance')),
                Tables\Columns\TextColumn::make('getAge')->label(__('Age')),
                Tables\Columns\TextColumn::make('placeBirth')->searchable()->sortable()->label(__('Lieu de Naissance')),
                Tables\Columns\TextColumn::make('recrutementDate')->searchable()->sortable()->date('d-m-Y')->label(__('Date de Recrutement')),
                Tables\Columns\TextColumn::make('phoneNumber')->searchable()->sortable()->label(__('Mobile')),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable()->label(__('Email')),
                
            ])
            ->filters([
              Filter::make('Recrutement_Date')
                 ->form([
                 Forms\Components\DatePicker::make('created_from')->label(__('Recrutés le')),
                 Forms\Components\DatePicker::make('created_until')->label(__('Jusqu\'a')),
                 ])
                 ->query(function (Builder $query, array $data): Builder {
                 return $query
                 ->when(
                 $data['created_from'],
                 fn (Builder $query, $date): Builder => $query->whereDate('recrutementDate', '>=', $date),
                  )
                 ->when(
                 $data['created_until'],
                 fn (Builder $query, $date): Builder => $query->whereDate('recrutementDate', '<=', $date),
                 );
                 })
              ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('Modifier'),
            ])
            ->bulkActions([
                
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    } 


}
