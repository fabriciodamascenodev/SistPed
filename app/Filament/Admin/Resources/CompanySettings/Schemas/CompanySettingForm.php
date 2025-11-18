<?php

namespace App\Filament\Admin\Resources\CompanySettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class CompanySettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')
                    ->label('Nome / Razão Social')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255)
                    ->columnSpan(2),

                TextInput::make('trade_name')
                    ->label('Nome Fantasia')
                    ->minLength(3)
                    ->maxLength(255),

                TextInput::make('cnpj')
                    ->label('CNPJ')
                    ->required()
                    ->mask('99.999.999/9999-99')
                    ->placeholder('00.000.000/0000-00')
                    ->maxLength(18)
                    ->unique(table: 'company_settings', ignoreRecord: true)
                    ->dehydrateStateUsing(fn($state) => preg_replace('/\D/', '', $state)),

                FileUpload::make('logo')
                    ->label('Logo da Empresa')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                    ->directory('company-logos')
                    ->columnSpan(2)
                    ->helperText('Formatos aceitos: JPG, JPEG, PNG, WebP. Tamanho máximo: 2MB'),

                TextInput::make('responsible')
                    ->label('Responsável')
                    ->minLength(3)
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('Telefone')
                    ->tel()
                    ->required()
                    ->mask('(99)99999-9999')
                    ->placeholder('(00)00000-0000')
                    ->maxLength(14),

                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->maxLength(255)
                    ->placeholder('contato@empresa.com.br'),

                TextInput::make('website')
                    ->label('Site')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://www.empresa.com.br'),
                TextInput::make('cep')
                    ->label('CEP')
                    ->mask('99999-999')
                    ->placeholder('00000-000')
                    ->maxLength(9),

                TextInput::make('address')
                    ->label('Endereço (Rua e Nº)')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255)
                    ->columnSpan(2),

                TextInput::make('complement')
                    ->label('Complemento')
                    ->minLength(3)
                    ->maxLength(255),

                TextInput::make('district')
                    ->label('Bairro')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255),

                TextInput::make('city')
                    ->label('Cidade')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255),

                TextInput::make('state')
                    ->label('Estado (Sigla)')
                    ->required()
                    ->length(2)
                    ->placeholder('RJ')
                    ->maxLength(2)
                    ])
            ->columns(2);                 
   }
}