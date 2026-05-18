<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Portofolio';
    protected static ?string $navigationLabel = 'Projects';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->required()
                ->rows(3),
            Textarea::make('problem_analysis')
                ->required()
                ->rows(5),
            TagsInput::make('tech_stack')
                ->required(),
            FileUpload::make('diagram')
                ->image()
                ->directory('diagrams')
                ->maxSize(25600) // 25MB
                ->nullable(),
            TextInput::make('github_url')
                ->url()
                ->nullable(),
            TextInput::make('demo_url')
                ->url()
                ->nullable(),
            Select::make('status')
                ->options([
                    'planning'    => 'Planning',
                    'in_progress' => 'In Progress',
                    'completed'   => 'Completed',
                ])
                ->required(),
            TextInput::make('progress')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->suffix('%')
                ->required(),
            Toggle::make('is_final_project')
                ->label('Final Project?'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable(),
            TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'planning'    => 'warning',
                    'in_progress' => 'info',
                    'completed'   => 'success',
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
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
