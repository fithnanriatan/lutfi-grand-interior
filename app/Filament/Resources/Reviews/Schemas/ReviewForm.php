<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Review')
                    ->schema([
                        // Relasi opsional ke booking (agar review bisa terkait pesanan)
                        Select::make('booking_id')
                            ->label('Booking (Opsional)')
                            ->relationship('booking', 'customer_name')
                            ->searchable()
                            ->preload()
                            ->helperText('Hubungkan review dengan booking yang ada'),
                        // Nama pelanggan yang memberikan review
                        TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),
                        // Email pelanggan (opsional)
                        TextInput::make('customer_email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        // Rating 1–5
                        Select::make('rating')
                            ->label('Rating')
                            ->options([
                                1 => '1 - Sangat Buruk',
                                2 => '2 - Buruk',
                                3 => '3 - Cukup',
                                4 => '4 - Baik',
                                5 => '5 - Sangat Baik',
                            ])
                            ->required()
                            ->native(false),
                        // Status persetujuan review (apakah ditampilkan di website)
                        Toggle::make('is_approved')
                            ->label('Disetujui')
                            ->default(false)
                            ->helperText('Review yang disetujui akan ditampilkan di website'),
                    ])
                    ->columns(2),
                
                Section::make('Komentar')
                    ->schema([
                        Textarea::make('comment')
                            ->label('Komentar')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}