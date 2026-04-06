<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMessagesWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';
    protected static ?string $heading = 'Pesan Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Message::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->color('info'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('WhatsApp')
                    ->default('-'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(60)
                    ->wrap(),

                Tables\Columns\IconColumn::make('is_read')
                    ->label('Dibaca')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since()
                    ->sortable(),
            ])
            ->recordAction(null)
            ->recordUrl(null);
    }
}
