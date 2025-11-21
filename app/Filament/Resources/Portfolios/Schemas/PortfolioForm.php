<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PortfolioForm
{
    // Mengatur struktur dan komponen form untuk input data portfolio
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //Bagian utama yang berisi informasi detail
                Section::make('Informasi Proyek')
                    ->schema([
                         // Nama proyek yang dikerjakan
                        TextInput::make('project_name')
                            ->label('Nama Proyek')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                         // Deskripsi lengkap proyek
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        // Nama klien yang memesan proyek
                        TextInput::make('client_name')
                            ->label('Nama Klien')
                            ->required()
                            ->maxLength(255),
                        // Lokasi proyek
                        TextInput::make('location')
                            ->label('Lokasi')
                            ->required()
                            ->maxLength(255),
                         // Tanggal proyek diselesaikan
                        DatePicker::make('completion_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->native(false)
                            ->displayFormat('d F Y'),
                         // Kategori proyek interior
                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Residential' => 'Residential',
                                'Commercial' => 'Commercial',
                                'Office' => 'Office',
                                'Hotel' => 'Hotel',
                                'Restaurant' => 'Restaurant',
                                'Cafe' => 'Cafe',
                                'Other' => 'Lainnya',
                            ])
                            ->required()
                            ->searchable(),
                    ])
                    ->columns(2),
                
                Section::make('Media')
                    ->schema([
                        //upload gambar
                        FileUpload::make('images')
                            ->label('Gambar Proyek')
                            ->image()
                            ->multiple()
                            ->directory('portfolios') //disimpan di storage/app/public/portfolios
                            ->maxFiles(10)
                            ->reorderable()
                            ->columnSpanFull(),
                        // Menandai proyek sebagai featured 
                        Toggle::make('is_featured')
                            ->label('Tampilkan sebagai Featured')
                            ->default(false)
                            ->helperText('Proyek unggulan akan ditampilkan di halaman utama'),
                    ]),
            ]);
    }
}