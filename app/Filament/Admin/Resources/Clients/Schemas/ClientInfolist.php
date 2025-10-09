<?php

namespace App\Filament\Admin\Resources\Clients\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class ClientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nome')
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->label('Telefone')
                    ->placeholder('-'),
                TextEntry::make('street')
                    ->label('Rua')
                    ->placeholder('-'),
                TextEntry::make('number')
                    ->label('Número')
                    ->placeholder('-'),
                TextEntry::make('complement')
                    ->label('Complemento')
                    ->placeholder('-'),
                TextEntry::make('city')
                    ->label('Cidade')
                    ->placeholder('-'),
                TextEntry::make('district')
                    ->label('Bairro')
                    ->placeholder('-'),
                TextEntry::make('reference')
                    ->label('Ponto de Referência')
                    ->placeholder('-'),
                TextEntry::make('cpf_cnpj')
                    ->label('CPF/CNPJ')
                    ->placeholder('-')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '-';
                        }

                        $cleaned = preg_replace('/\D/', '', $state);

                        if (strlen($cleaned) > 11) {
                            // CNPJ
                            return preg_replace(
                                '/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/',
                                '$1.$2.$3/$4-$5',
                                $cleaned
                            );
                        } else {
                            // CPF
                            return preg_replace(
                                '/(\d{3})(\d{3})(\d{3})(\d{2})/',
                                '$1.$2.$3-$4',
                                $cleaned
                            );
                        }
                    }),                    
            ]);
    }
}
