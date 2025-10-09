<?php

namespace App\Filament\Admin\Resources\Clients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),
                TextColumn::make('street')
                    ->label('Rua')
                    ->searchable(),
                TextColumn::make('number')
                    ->label('Número')
                    ->searchable(),
                TextColumn::make('complement')
                    ->label('Complemento')
                    ->searchable(),
                TextColumn::make('district')
                    ->label('Bairro')
                    ->searchable(),
                TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable(),
                TextColumn::make('reference')
                    ->label('Ponto de Referência')
                    ->searchable(),
                TextColumn::make('cpf_cnpj')
                    ->label('CPF/CNPJ')
                    ->searchable()
                    ->formatStateUsing(function (?string $state): ?string {
                        if (empty($state)) {
                            return null;
                        }

                        $cleanedState = preg_replace('/[^0-9]/', '', $state);

                        // Se tiver 11 dígitos, formata como CPF
                        if (strlen($cleanedState) === 11) {
                            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cleanedState);
                        }

                        // Se tiver 14 dígitos, formata como CNPJ
                        if (strlen($cleanedState) === 14) {
                            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cleanedState);
                        }

                        // Se não for nenhum dos dois, retorna o valor original
                        return $state;
                    }),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
