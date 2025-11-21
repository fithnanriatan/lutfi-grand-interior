<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BookingChart extends ChartWidget
{
    protected ?string $heading = 'Booking Per Bulan (Tahun Ini)'; // Tanpa static
    
    protected static ?int $sort = 2; // Dengan static
    
    protected ?string $maxHeight = '300px'; // Tanpa static

    protected function getData(): array
    {
        $data = Booking::select(
            DB::raw('MONTH(booking_date) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('booking_date', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month')
        ->toArray();

        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        $chartData = [];
        foreach ($months as $num => $name) {
            $chartData[$name] = $data[$num] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Booking',
                    'data' => array_values($chartData),
                    'backgroundColor' => 'rgba(147, 51, 234, 0.1)',
                    'borderColor' => 'rgba(147, 51, 234, 1)',
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => array_keys($chartData),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}