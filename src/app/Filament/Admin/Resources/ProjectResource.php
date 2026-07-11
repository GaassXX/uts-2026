<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Portofolio';
    protected static ?string $navigationLabel = 'Project';
    protected static ?string $modelLabel = 'Project';


    public static function form(Form $form): Form
    {
        return $form->schema([

            Section::make('Info Dasar')
                ->description('Informasi umum project')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))
                        ),
                    TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),
                    Textarea::make('description')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),
                    FileUpload::make('thumbnail')
                        ->label('Thumbnail / Cover')
                        ->image()
                        ->directory('thumbnails')
                        ->maxSize(25600)
                        ->nullable()
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Detail Laporan')
                ->description('Analisis dan solusi project')
                ->schema([
                    Textarea::make('problem_analysis')
                        ->label('Analisis Masalah')
                        ->required()
                        ->rows(5),
                    Textarea::make('solution')
                        ->label('Solusi yang Ditawarkan')
                        ->nullable()
                        ->rows(5),
                    TagsInput::make('features')
                        ->label('Fitur Utama')
                        ->nullable()
                        ->columnSpanFull(),
                    TagsInput::make('tech_stack')
                        ->label('Tech Stack')
                        ->required()
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Diagram & Dokumentasi')
                ->description('Upload diagram dan dokumen project')
                ->schema([
                    FileUpload::make('flowchart')
                        ->label('Flowchart Sistem')
                        ->image()
                        ->directory('diagrams/flowchart')
                        ->maxSize(25600)
                        ->nullable(),
                    FileUpload::make('erd_diagram')
                        ->label('ERD Diagram')
                        ->image()
                        ->directory('diagrams/erd')
                        ->maxSize(25600)
                        ->nullable(),
                    FileUpload::make('use_case')
                        ->label('Use Case Diagram')
                        ->image()
                        ->directory('diagrams/usecase')
                        ->maxSize(25600)
                        ->nullable(),
                    FileUpload::make('diagram')
                        ->label('Diagram Lainnya')
                        ->image()
                        ->directory('diagrams/other')
                        ->maxSize(25600)
                        ->nullable(),
                    FileUpload::make('document')
                        ->label('Dokumen PDF (Laporan)')
                        ->acceptedFileTypes(['application/pdf'])
                        ->directory('documents')
                        ->maxSize(25600)
                        ->nullable()
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Links')
                ->schema([
                    TextInput::make('github_url')
                        ->label('GitHub URL')
                        ->url()
                        ->nullable(),
                    TextInput::make('demo_url')
                        ->label('Demo URL')
                        ->url()
                        ->nullable(),
                ])->columns(2),

            Section::make('Status & Progress')
                ->schema([
                    Select::make('status')
                        ->options([
                            'planning' => 'Planning',
                            'in_progress' => 'In Progress',
                            'completed' => 'Completed',
                        ])
                        ->required(),
                    TextInput::make('progress')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->suffix('%')
                        ->required(),
                    Toggle::make('is_final_project')
                        ->label('Final Project?')
                        ->columnSpanFull(),
                ])->columns(2),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail')
                ->circular(false)
                ->size(50),
            TextColumn::make('title')->searchable(),
            TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'planning' => 'warning',
                    'in_progress' => 'info',
                    'completed' => 'success',
                }),
            TextColumn::make('progress')->suffix('%'),
            IconColumn::make('is_final_project')->boolean(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
