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
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Proyek')
                    ->schema([
                        TextInput::make('project_name')
                            ->label('Nama Proyek')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        
                        TextInput::make('client_name')
                            ->label('Nama Klien')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('location')
                            ->label('Lokasi')
                            ->required()
                            ->maxLength(255),
                        
                        DatePicker::make('completion_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->native(false)
                            ->displayFormat('d F Y'),
                        
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
                        FileUpload::make('images')
                            ->label('Gambar Proyek')
                            ->image()
                            ->multiple()
                            ->directory('portfolios')
                            ->maxFiles(10)
                            ->reorderable()
                            ->columnSpanFull(),
                        
                        Toggle::make('is_featured')
                            ->label('Tampilkan sebagai Featured')
                            ->default(false)
                            ->helperText('Proyek unggulan akan ditampilkan di halaman utama'),
                    ]),
            ]);
    }
}