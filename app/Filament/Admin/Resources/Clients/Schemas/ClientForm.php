<?php

namespace App\Filament\Admin\Resources\Clients\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Telefone')
                    ->tel()
                    ->required()
                    ->maxlength(20),
                TextInput::make('street')
                    ->label('Rua')
                    ->maxlength(255),
                TextInput::make('number')
                    ->label('Número')
                    ->maxlength(3),
                TextInput::make('complement')
                    ->label('Complemento')
                    ->maxlength(255),
                TextInput::make('city')
                    ->label('Cidade')
                    ->maxlength(255),
                TextInput::make('district')
                    ->label('Bairro')
                    ->maxlength(255),
                TextInput::make('reference')
                    ->label('Ponto de Referência')
                    ->maxlength(255),
                TextInput::make('cpf_cnpj')
                    ->label('CPF/CNPJ')
                    ->maxlength(20),
            ]);
    }
}
