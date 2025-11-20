<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Layanan')
                    ->schema([
                        TextEntry::make('service.name')
                            ->label('Layanan'),
                        
                        TextEntry::make('booking_date')
                            ->label('Tanggal Booking')
                            ->date('d F Y'),
                        
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'confirmed' => 'info',
                                'in_progress' => 'primary',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pending' => 'Pending',
                                'confirmed' => 'Dikonfirmasi',
                                'in_progress' => 'Sedang Dikerjakan',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            }),
                    ])
                    ->columns(3),
                
                Section::make('Informasi Pelanggan')
                    ->schema([
                        TextEntry::make('customer_name')
                            ->label('Nama Pelanggan'),
                        
                        TextEntry::make('customer_email')
                            ->label('Email')
                            ->copyable(),
                        
                        TextEntry::make('customer_phone')
                            ->label('No. Telepon')
                            ->copyable(),
                        
                        TextEntry::make('customer_address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('Catatan & Informasi Lainnya')
                    ->schema([
                        TextEntry::make('notes')
                            ->label('Catatan')
                            ->default('-')
                            ->columnSpanFull(),
                        
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d F Y, H:i'),
                        
                        TextEntry::make('updated_at')
                            ->label('Diperbarui')
                            ->dateTime('d F Y, H:i'),
                    ])
                    ->columns(2),
            ]);
    }
}