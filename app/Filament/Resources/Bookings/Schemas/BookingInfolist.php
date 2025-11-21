<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingInfolist
{
    //mengatur tampilan untuk data booking 
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Layanan')
                    ->schema([
                        //Nama layanan diambil dari relasi service.name
                        TextEntry::make('service.name')
                            ->label('Layanan'),
                        //tmpilan tgl booking
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
                            //menentukan warna berdasarkan status
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pending' => 'Pending',
                                'confirmed' => 'Dikonfirmasi',
                                'in_progress' => 'Sedang Dikerjakan',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            }), //tmpiln label
                    ])
                    ->columns(3),
                
                Section::make('Informasi Pelanggan')
                    ->schema([
                        // Nama pelanggan
                        TextEntry::make('customer_name')
                            ->label('Nama Pelanggan'),
                        // email
                        TextEntry::make('customer_email')
                            ->label('Email')
                            ->copyable(),
                        // no telepon
                        TextEntry::make('customer_phone')
                            ->label('No. Telepon')
                            ->copyable(),
                        // alamat
                        TextEntry::make('customer_address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Section::make('Catatan & Informasi Lainnya')
                    ->schema([
                        //data dibuat
                        TextEntry::make('notes')
                            ->label('Catatan')
                            ->default('-')
                            ->columnSpanFull(),
                        //data di perbarui
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