<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->label('Cliente')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->native(false),

                Select::make('payment_method')
                    ->label('Forma de Pagamento')
                    ->options([
                        'cash' => 'À Vista',
                        'billed' => 'Faturado',
                    ])
                    ->required()
                    ->native(false)
                    ->live(), // "live" para o repeater escutar a mudança

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'completed' => 'Concluído',
                        'cancelled' => 'Cancelado',
                    ])
                    ->default('pending')
                    ->required()
                    ->native(false),

                Repeater::make('items')
                    ->label('Itens do Pedido')
                    ->relationship()
                    ->schema([
                        Select::make('product_id')
                            ->label('Produto')
                            ->options(Product::pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                if (! $state) return;

                                $product = Product::find($state);
                                $paymentMethod = $get('../../payment_method');
                                
                                if ($product) {
                                    $price = ($paymentMethod === 'billed') 
                                        ? $product->billed_price 
                                        : $product->cash_price;

                                    // CORREÇÃO: Formata com 2 casas decimais
                                    $set('unit_price', number_format($price, 2, '.', ''));
                                    
                                    $quantity = (int) $get('quantity') ?: 1;
                                    $subtotal = $price * $quantity;
                                    // CORREÇÃO: Formata subtotal com 2 casas decimais
                                    $set('subtotal', number_format($subtotal, 2, '.', ''));
                                }
                            }),

                        TextInput::make('quantity')
                            ->label('Quantidade')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, $get, $set) {
                                $unitPrice = (float) $get('unit_price');
                                $subtotal = $state * $unitPrice;
                                // CORREÇÃO: Formata subtotal com 2 casas decimais
                                $set('subtotal', number_format($subtotal, 2, '.', ''));
                            }),

                        TextInput::make('unit_price')
                            ->label('Preço Unitário')
                            ->numeric()
                            ->prefix('R$')
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->prefix('R$')
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columns(4)
                    ->defaultItems(1)
                    ->addActionLabel('Adicionar Item')
                    ->collapsible()
                    ->cloneable()
                    ->columnSpanFull()
                    ->live()
                    ->afterStateUpdated(function ($get, $set) {
                        $items = $get('items');
                        $total = 0;
                        if (is_array($items)) {
                            foreach ($items as $item) {
                                $total += (float) ($item['subtotal'] ?? 0);
                            }
                        }
                        $set('total_amount', number_format($total, 2, '.', ''));
                    }),

                TextInput::make('total_amount')
                    ->label('Total do Pedido')
                    ->numeric()
                    ->prefix('R$')
                    ->disabled()
                    ->dehydrated(false),
            ])
            ->columns(2);
    }
}