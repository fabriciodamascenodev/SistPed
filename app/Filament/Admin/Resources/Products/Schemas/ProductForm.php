<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema; 
use Filament\Support\RawJs; 

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Descrição')
                    ->maxLength(65535),
                TextInput::make('quantity')
                    ->label('Quantidade')                    
                    ->numeric()
                    ->default(0),
                TextInput::make('sku')
                    ->label('SKU')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('barcode')
                    ->label('Código de Barras')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('cash_price')
                    ->label('Preço à Vista')
                    ->numeric()
                    ->prefix('R$'),
                TextInput::make('billed_price')
                    ->label('Preço Faturado')
                    ->numeric()
                    ->prefix('R$'),
            ]);
    }
}