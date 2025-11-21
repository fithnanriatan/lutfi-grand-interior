<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingForm
{
    //Fungsi utama untuk mengatur schema form Booking
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //isi informasi layanan
                Section::make('Informasi Layanan')
                    ->schema([
                        //dropdown
                        Select::make('service_id')
                            ->label('Layanan Interior')
                            ->relationship('service', 'name') //relasi tabel
                            ->required()
                            ->searchable()
                            ->preload(),
                        //input tgl
                        DatePicker::make('booking_date')
                            ->label('Tanggal Booking')
                            ->required()
                            ->native(false)
                            ->displayFormat('d F Y'),
                        //pilihan status
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Dikonfirmasi',
                                'in_progress' => 'Sedang Dikerjakan',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->required()
                            ->default('pending'),
                    ])
                    ->columns(3),//frorm di bagi menjadi 3
                //data pelanggan
                Section::make('Informasi Pelanggan')
                    ->schema([
                        //nama pelanggan
                        TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),
                        //email pelanggan
                        TextInput::make('customer_email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        //no tlp pelanggan
                        TextInput::make('customer_phone')
                            ->label('No. Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('customer_address')
                            ->label('Alamat')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                //nambah catatan 
                Section::make('Catatan')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Catatan Tambahan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}