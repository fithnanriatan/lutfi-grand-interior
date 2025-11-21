<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section utama untuk detail layanan
                Section::make('Informasi Layanan')
                    ->schema([
                        // Menampilkan gambar layanan
                        ImageEntry::make('image')
                            ->label('Gambar')
                            ->columnSpanFull(), // gambar ditampilkan penuh
                         // Menampilkan nama layanan
                        TextEntry::make('name')
                            ->label('Nama Layanan'),
                        // Menampilkan harga layanan dalam format uang
                        TextEntry::make('price')
                            ->label('Harga')
                            ->money('IDR'),
                        // Menampilkan durasi pengerjaan
                        TextEntry::make('duration')
                            ->label('Durasi Pengerjaan'),
                        // Menampilkan status aktif/tidak 
                        IconEntry::make('is_active')
                            ->label('Status')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                        // Menampilkan deskripsi layanan
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        // Menampilkan tanggal dibuat
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d F Y, H:i'),
                        // Menampilkan tanggal diperbarui
                        TextEntry::make('updated_at')
                            ->label('Diperbarui')
                            ->dateTime('d F Y, H:i'),
                    ])
                    ->columns(2),
            ]);
    }
}