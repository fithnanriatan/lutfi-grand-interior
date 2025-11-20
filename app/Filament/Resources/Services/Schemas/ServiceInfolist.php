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
                Section::make('Informasi Layanan')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Gambar')
                            ->columnSpanFull(),
                        
                        TextEntry::make('name')
                            ->label('Nama Layanan'),
                        
                        TextEntry::make('price')
                            ->label('Harga')
                            ->money('IDR'),
                        
                        TextEntry::make('duration')
                            ->label('Durasi Pengerjaan'),
                        
                        IconEntry::make('is_active')
                            ->label('Status')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                        
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        
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