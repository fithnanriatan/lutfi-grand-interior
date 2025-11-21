<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Bagian utama form dalam satu Section
                Section::make()
                    ->schema([
                        // Input nama layanan
                        TextInput::make('name')
                            ->label('Nama Layanan')
                            ->required() // wajib diisi
                            ->maxLength(255), // batas panjang teks
                        // Input deskripsi layanan
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        // Input harga layanan (angka)
                        TextInput::make('price')
                            ->label('Harga')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->maxValue(999999999999.99),
                        // Input durasi pengerjaan
                        TextInput::make('duration')
                            ->label('Durasi Pengerjaan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh: 2-3 minggu'),
                        // Upload gambar layanan
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->image() // memastikan file adalah gambar
                            ->directory('services')
                            ->columnSpanFull()
                            ->image() // Memastikan hanya boleh upload gambar
                            ->disk('public') // <--- WAJIB DITAMBAHKAN AGAR GAMBAR MUNCUL
                            ->directory('services') // Folder penyimpanan (opsional)
                            ->visibility('public') // Memastikan file bisa diakses browser
                            ->required(),
                        // Toggle status aktif/tidak
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true), // nilai default aktif
                    ])
                    ->columns(2),
            ]);
    }
}
