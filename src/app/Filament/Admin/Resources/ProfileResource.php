<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
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

            Section::make('Informasi Dasar')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('tagline')
                        ->nullable()
                        ->maxLength(255),
                    Textarea::make('bio')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                    FileUpload::make('photo')
                        ->image()
                        ->directory('profiles')
                        ->nullable()
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Kontak & Sosial')
                ->schema([
                    TextInput::make('email')
                        ->email()
                        ->required(),
                    TextInput::make('whatsapp')
                        ->nullable()
                        ->placeholder('+62 812-3456-7890'),
                    TextInput::make('github')
                        ->nullable()
                        ->url(),
                    TextInput::make('linkedin')
                        ->nullable()
                        ->url(),
                    TextInput::make('instagram')
                        ->nullable()
                        ->placeholder('@username'),
                    TextInput::make('location')
                        ->nullable()
                        ->placeholder('Kota, Indonesia'),
                ])->columns(2),

            Section::make('Skills & Stats')
                ->schema([
                    TagsInput::make('skills')
                        ->required()
                        ->columnSpanFull(),
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
                        ->default('Available for work')
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('About Detail & CV')
                ->schema([
                    Textarea::make('about_detail')
                        ->label('About Detail (untuk section Tentang Saya)')
                        ->nullable()
                        ->rows(4)
                        ->columnSpanFull(),
                    TextInput::make('cv_url')
                        ->label('CV URL (Google Drive / link download)')
                        ->nullable()
                        ->url()
                        ->columnSpanFull(),
                ]),

            Section::make('Skill Percentages')
                    ->description('Isi persentase untuk setiap skill (0-100)')
                    ->schema([
                    \Filament\Forms\Components\Repeater::make('skill_percentages')
                    ->schema([
                TextInput::make('name')
                    ->required()
                    ->placeholder('Laravel'),
                TextInput::make('percentage')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%'),
                ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->nullable(),
                ]),

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
            'index'  => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit'   => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
