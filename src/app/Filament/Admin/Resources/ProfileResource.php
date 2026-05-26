<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Portofolio';
    protected static ?string $navigationLabel = 'Profile';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('tagline')
                ->nullable()
                ->maxLength(255),
            Textarea::make('bio')
                ->required()
                ->rows(4),
            FileUpload::make('photo')
                ->image()
                ->directory('profiles')
                ->nullable(),
            TextInput::make('email')
                ->email()
                ->required(),
            TextInput::make('github')
                ->nullable()
                ->url(),
            TextInput::make('linkedin')
                ->nullable()
                ->url(),
            TagsInput::make('skills')
                ->required(),
            TextInput::make('years_experience')
                ->numeric()
                ->required()
                ->suffix('Years')
                ->default(1),
            TextInput::make('total_projects')
                ->numeric()
                ->required()
                ->suffix('Projects')
                ->default(0),
            TextInput::make('availability')
                ->required()
                ->default('Available for work'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('email'),
            TextColumn::make('tagline'),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
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
