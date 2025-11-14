<?php

namespace App\Filament\Admin\Resources\CompanySettings;

use App\Filament\Admin\Resources\CompanySettings\Pages\EditCompanySetting;
use App\Filament\Admin\Resources\CompanySettings\Pages\ListCompanySettings;
use App\Filament\Admin\Resources\CompanySettings\Schemas\CompanySettingForm;
use App\Filament\Admin\Resources\CompanySettings\Tables\CompanySettingsTable;
use App\Models\CompanySetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanySettingResource extends Resource
{
    protected static ?string $model = CompanySetting::class;
    protected static ?string $modelLabel = 'Configuração';
    protected static ?string $pluralModelLabel = 'Configurações';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $recordTitleAttribute = 'company_name';

    public static function form(Schema $schema): Schema
    {
        return CompanySettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanySettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => EditCompanySetting::route('/'),
        ];
    }
}