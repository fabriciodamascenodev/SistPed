<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label('Nome'),
                TextEntry::make('description')->label('Descrição'),
                ImageEntry::make('image_path')
                    ->label('Imagem')
                    ->defaultImageUrl(asset('images/no-image.png'))
                    ->size(200)
                    ->columnSpanFull()
                    ->getStateUsing(fn ($record) => $record->image_path ? Storage::disk('public')->url($record->image_path) : null),
                TextEntry::make('quantity')->label('Quantidade'),
                TextEntry::make('sku')->label('SKU'),
                TextEntry::make('barcode')->label('Código de Barras'),
                TextEntry::make('cash_price')
                    ->label('Preço à Vista')
                    ->money('BRL'),
                TextEntry::make('billed_price')
                    ->label('Preço Faturado')
                    ->money('BRL'),
            ]);
    }
}