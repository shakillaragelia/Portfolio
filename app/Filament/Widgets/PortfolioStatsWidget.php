<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\Message;
use App\Models\Comment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Projects', Project::where('is_active', true)->count())
                ->description('Projects aktif di portfolio')
                ->descriptionIcon('heroicon-m-code-bracket')
                ->color('info')
                ->chart(
                    Project::selectRaw('COUNT(*) as count')
                        ->groupBy('year')
                        ->orderBy('year')
                        ->pluck('count')
                        ->toArray()
                ),

            Stat::make('Pesan Masuk', Message::count())
                ->description(Message::where('is_read', false)->count() . ' belum dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color(Message::where('is_read', false)->count() > 0 ? 'warning' : 'success'),

            Stat::make('Komentar', Comment::count())
                ->description(Comment::where('is_approved', true)->count() . ' approved')
                ->descriptionIcon('heroicon-m-chat-bubble-left')
                ->color('success'),
        ];
    }
}
