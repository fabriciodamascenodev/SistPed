<?php

namespace App\Filament\Admin\Resources\CompanySettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompanySettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->height(50),
                    
                TextColumn::make('company_name')
                    ->label('Razão Social')
                    ->searchable(),
                    
                TextColumn::make('cnpj')
                    ->label('CNPJ')
                    ->formatStateUsing(function (?string $state): ?string {
                        if (empty($state)) {
                            return null;
                        }
                        $cleaned = preg_replace('/\D/', '', $state);
                        if (strlen($cleaned) === 14) {
                            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cleaned);
                        }
                        return $state;
                    }),
                    
                TextColumn::make('phone')
                    ->label('Telefone'),
                    
                TextColumn::make('city')
                    ->label('Cidade'),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}