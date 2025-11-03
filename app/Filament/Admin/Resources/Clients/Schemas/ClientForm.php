<?php

namespace App\Filament\Admin\Resources\Clients\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Telefone')
                    ->tel()
                    ->mask('(99)99999-9999')
                    ->required()
                    ->maxlength(14),
                TextInput::make('cep')
                    ->label('CEP')
                    ->mask('99999-999')
                    ->placeholder('00000-000'),                
                TextInput::make('street')
                    ->label('Rua')
                    ->required()
                    ->minLength(3)
                    ->maxlength(255),
                TextInput::make('number')
                    ->label('Número')
                    ->required()
                    ->minLength(1)
                    ->maxlength(4),
                TextInput::make('complement')
                    ->label('Complemento')
                    ->minLength(3)
                    ->maxlength(255),
                TextInput::make('district')
                    ->label('Bairro')
                    ->required()
                    ->minLength(3)
                    ->maxlength(255),
                TextInput::make('city')
                    ->label('Cidade')
                    ->required()
                    ->minLength(3)
                    ->maxlength(255),
                TextInput::make('state')
                    ->label('Estado (Sigla)')
                    ->required() 
                    ->length(2)  
                    ->placeholder('RJ'),
                TextInput::make('reference')
                    ->label('Ponto de Referência')
                    ->minLength(3)
                    ->maxlength(255),                
                TextInput::make('cpf_cnpj')
                    ->label('CPF/CNPJ')
                    ->mask(RawJs::make(<<<'JS'
                        function(input) {
                            const cleaned = input.replace(/\D/g, '');
                            return cleaned.length > 11 
                                ? '99.999.999/9999-99' 
                                : '999.999.999-99';
                        }
                    JS))
                    ->maxlength(18)             
                    ->dehydrateStateUsing(fn($state) => preg_replace('/\D/', '', $state)),                    
            ]);
    }
}
