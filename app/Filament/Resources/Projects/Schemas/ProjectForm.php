<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('long_description')
                    ->columnSpanFull(),
                TextInput::make('thumbnail'),
                Textarea::make('tags')
                    ->columnSpanFull(),
                Textarea::make('tech_stack')
                    ->columnSpanFull(),
                Textarea::make('features')
                    ->columnSpanFull(),
                TextInput::make('type')
                    ->required()
                    ->default('fullstack'),
                TextInput::make('role'),
                TextInput::make('duration'),
                TextInput::make('year'),
                TextInput::make('demo_url')
                    ->url(),
                TextInput::make('github_url')
                    ->url(),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
