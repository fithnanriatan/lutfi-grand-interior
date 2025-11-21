<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Widgets\ChartWidget;

class ReviewStatsChart extends ChartWidget
{
    protected ?string $heading = 'Statistik Review';
    
    protected static ?int $sort = 3;
    
    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $approved = Review::where('is_approved', true)->count();
        $pending = Review::where('is_approved', false)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Review',
                    'data' => [$approved, $pending],
                    'backgroundColor' => [
                        'rgba(34, 197, 94, 0.8)',  // green for approved
                        'rgba(251, 191, 36, 0.8)', // yellow for pending
                    ],
                    'borderColor' => [
                        'rgba(34, 197, 94, 1)',
                        'rgba(251, 191, 36, 1)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Disetujui', 'Pending'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}