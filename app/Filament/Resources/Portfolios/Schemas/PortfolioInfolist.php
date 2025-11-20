<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PortfolioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Galeri Proyek')
                    ->schema([
                        ImageEntry::make('images')
                            ->label('Gambar')
                            ->columnSpanFull(),
                    ]),
                
                Section::make('Informasi Proyek')
                    ->schema([
                        TextEntry::make('project_name')
                            ->label('Nama Proyek')
                            ->columnSpanFull(),
                        
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        
                        TextEntry::make('client_name')
                            ->label('Nama Klien'),
                        
                        TextEntry::make('location')
                            ->label('Lokasi'),
                        
                        TextEntry::make('completion_date')
                            ->label('Tanggal Selesai')
                            ->date('d F Y'),
                        
                        TextEntry::make('category')
                            ->label('Kategori')
                            ->badge(),
                        
                        IconEntry::make('is_featured')
                            ->label('Featured')
                            ->boolean()
                            ->trueIcon('heroicon-o-star')
                            ->falseIcon('heroicon-o-star')
                            ->trueColor('warning')
                            ->falseColor('gray'),
                    ])
                    ->columns(2),
                
                Section::make('Informasi Lainnya')
                    ->schema([
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