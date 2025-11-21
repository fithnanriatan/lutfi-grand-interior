<?php

namespace App\Filament\Resources\Portfolios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class PortfoliosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 // Nama Proyek 
                TextColumn::make('project_name')
                    ->label('Nama Proyek')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                // Nama klien
                TextColumn::make('client_name')
                    ->label('Nama Klien')
                    ->searchable()
                    ->sortable(),

                // Lokasi proyek + icon map
                TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable()
                    ->icon('heroicon-o-map-pin')
                    ->toggleable(), // bisa disembunyikan dari table

                // Kategori proyek dengan badge warna
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Residential' => 'success',
                        'Commercial' => 'primary',
                        'Office' => 'info',
                        'Hotel' => 'warning',
                        'Restaurant' => 'danger',
                        'Cafe' => 'gray',
                        'Other' => 'secondary',
                        default => 'gray',
                    })
                    ->sortable()
                    ->searchable(),

                // Tanggal selesai
                TextColumn::make('completion_date')
                    ->label('Tanggal Selesai')
                    ->date('d F Y')
                    ->sortable(),

                // Deskripsi 
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter berdasarkan kategori
                SelectFilter::make('category')
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
                    ->multiple(),

                // Filter berdasarkan rentang tanggal selesai
                Filter::make('completion_date')
                    ->form([
                        DatePicker::make('completed_from')
                            ->label('Dari Tanggal'),
                        DatePicker::make('completed_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['completed_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('completion_date', '>=', $date),
                            )
                            ->when(
                                $data['completed_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('completion_date', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make(), // lihat detail
                EditAction::make(), // edit
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('completion_date', 'desc'); // terbaru muncul di atas
    }
}
