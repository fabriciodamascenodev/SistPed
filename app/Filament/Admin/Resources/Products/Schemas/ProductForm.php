<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema; 
use Filament\Support\RawJs; 
use Illuminate\Support\Facades\Storage;

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
                FileUpload::make('image_path')
                    ->label('Imagem do Produto')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                         '16:9',
                         '4:3',
                         '1:1',
                     ])
                    ->directory('products')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                    ->maxSize(2048) // 2MB
                    ->helperText('Formatos aceitos: JPG, JPEG, PNG. Tamanho máximo: 2MB.')
                    ->columnSpanFull(),
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