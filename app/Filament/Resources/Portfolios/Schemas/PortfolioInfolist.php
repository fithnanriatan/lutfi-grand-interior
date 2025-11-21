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
                // Menampilkan semua gambar proyek
                Section::make('Galeri Proyek')
                    ->schema([
                         // ImageEntry: menampilkan daftar gambar
                        // Field 'images' harus berupa array URL
                        ImageEntry::make('images')
                            ->label('Gambar')
                            ->columnSpanFull(), // memakai seluruh lebar
                    ]),
                
                Section::make('Informasi Proyek')
                    ->schema([
                         // Nama proyek
                        TextEntry::make('project_name')
                            ->label('Nama Proyek')
                            ->columnSpanFull(),
                        // Deskripsi
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        // Nama klien
                        TextEntry::make('client_name')
                            ->label('Nama Klien'),
                        // Lokasi proyek
                        TextEntry::make('location')
                            ->label('Lokasi'),
                         // Tanggal selesai 
                        TextEntry::make('completion_date')
                            ->label('Tanggal Selesai')
                            ->date('d F Y'),
                        // Status 
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
                        // Waktu create record
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d F Y, H:i'),
                         // Waktu update record
                        TextEntry::make('updated_at')
                            ->label('Diperbarui')
                            ->dateTime('d F Y, H:i'),
                    ])
                    ->columns(2),
            ]);
    }
}