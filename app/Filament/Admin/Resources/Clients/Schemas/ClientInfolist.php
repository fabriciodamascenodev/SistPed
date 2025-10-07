<?php

namespace App\Filament\Admin\Resources\Clients\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

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
                    ->placeholder('-'),
                    /*
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->placeholder('-'),
                    */
            ]);
    }
}
