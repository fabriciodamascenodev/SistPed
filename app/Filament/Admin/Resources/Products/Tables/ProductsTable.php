<?php

namespace App\Filament\Admin\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                ImageColumn::make('image_path')
                    ->label('Imagem')
                    ->defaultImageUrl(asset('images/no-image.png'))
                    ->size(50)
                    ->circular()
                    ->getStateUsing(fn ($record) => $record->image_path ? 
                        Storage::disk('public')->url($record->image_path) : null),
                TextColumn::make('quantity')
                    ->label('Qtd.')
                    ->sortable(),
                TextColumn::make('cash_price')
                    ->label('Preço à Vista')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('billed_price')
                    ->label('Preço Faturado')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->label('Data de Criação')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
