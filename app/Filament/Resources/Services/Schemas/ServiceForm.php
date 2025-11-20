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
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Layanan')
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        
                        TextInput::make('price')
                            ->label('Harga')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->maxValue(999999999999.99),
                        
                        TextInput::make('duration')
                            ->label('Durasi Pengerjaan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh: 2-3 minggu'),
                        
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->directory('services')
                            ->columnSpanFull(),
                        
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}