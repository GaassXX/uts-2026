<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Portofolio';
    protected static ?string $navigationLabel = 'Experience';
    protected static ?string $modelLabel = 'Pengalaman';


    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            TextInput::make('company')
                ->nullable()
                ->maxLength(255),
            TextInput::make('period')
                ->required()
                ->placeholder('2023 - Sekarang'),
            TextInput::make('order')
                ->numeric()
                ->default(0),
            Textarea::make('description')
                ->nullable()
                ->rows(3)
                ->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('order')->sortable(),
            TextColumn::make('title')->searchable(),
            TextColumn::make('company'),
            TextColumn::make('period'),
        ])
        ->defaultSort('order')
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit'   => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
