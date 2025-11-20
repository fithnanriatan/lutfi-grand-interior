<?php

namespace App\Filament\Resources\Reviews\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Collection;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('customer_email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope')
                    ->toggleable(),

                TextColumn::make('booking.customer_name')
                    ->label('Booking Terkait')
                    ->searchable()
                    ->toggleable()
                    ->placeholder('Tidak ada booking')
                    ->badge()
                    ->color('info'),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->color(fn(int $state): string => match ($state) {
                        1 => 'danger',
                        2 => 'warning',
                        3 => 'gray',
                        4 => 'success',
                        5 => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(int $state): string => match ($state) {
                        1 => '⭐ 1 - Sangat Buruk',
                        2 => '⭐⭐ 2 - Buruk',
                        3 => '⭐⭐⭐ 3 - Cukup',
                        4 => '⭐⭐⭐⭐ 4 - Baik',
                        5 => '⭐⭐⭐⭐⭐ 5 - Sangat Baik',
                        default => $state,
                    })
                    ->sortable(),

                ToggleColumn::make('is_approved')
                    ->label('Status')
                    ->sortable()
                    ->afterStateUpdated(function ($record, $state) {
                        // Optional: Log atau notifikasi ketika status berubah
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal Review')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('rating')
                    ->label('Rating')
                    ->options([
                        1 => '⭐ 1 - Sangat Buruk',
                        2 => '⭐⭐ 2 - Buruk',
                        3 => '⭐⭐⭐ 3 - Cukup',
                        4 => '⭐⭐⭐⭐ 4 - Baik',
                        5 => '⭐⭐⭐⭐⭐ 5 - Sangat Baik',
                    ])
                    ->multiple(),

                TernaryFilter::make('is_approved')
                    ->label('Status Persetujuan')
                    ->placeholder('Semua review')
                    ->trueLabel('Hanya yang disetujui')
                    ->falseLabel('Hanya yang belum disetujui'),

                Filter::make('has_booking')
                    ->label('Memiliki Booking')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('booking_id')),

                Filter::make('no_booking')
                    ->label('Tanpa Booking')
                    ->query(fn(Builder $query): Builder => $query->whereNull('booking_id')),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('approve')
                        ->label('Setujui Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn(Collection $records) => $records->each->update(['is_approved' => true]))
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation(),

                    BulkAction::make('reject')
                        ->label('Tolak Terpilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn(Collection $records) => $records->each->update(['is_approved' => false]))
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation(),

                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
