<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Portfolio;
use App\Models\Review;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Layanan', Service::count())
                ->description('Layanan interior tersedia')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            
            Stat::make('Total Booking', Booking::count())
                ->description('Pemesanan masuk')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning')
                ->chart([3, 5, 7, 8, 6, 9, 10, 8]),
            
            Stat::make('Booking Pending', Booking::where('status', 'pending')->count())
                ->description('Menunggu konfirmasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),
            
            Stat::make('Total Portfolio', Portfolio::count())
                ->description('Proyek selesai')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info')
                ->chart([2, 4, 3, 5, 4, 6, 5, 7]),
            
            Stat::make('Review Pending', Review::where('is_approved', false)->count())
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
            
            Stat::make('Total Review', Review::where('is_approved', true)->count())
                ->description('Review disetujui')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}