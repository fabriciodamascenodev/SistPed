<?php

namespace App\Filament\Admin\Resources\CompanySettings\Pages;

use App\Filament\Admin\Resources\CompanySettings\CompanySettingResource;
use App\Models\CompanySetting;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditCompanySetting extends EditRecord
{
    protected static string $resource = CompanySettingResource::class;

    public function mount(int | string $record = null): void
    {
        $this->record = CompanySetting::firstOrCreate(['id' => 1], [
            'company_name' => '',
            'cnpj' => '',
            'phone' => '',
            'address' => '',
            'district' => '',
            'city' => '',
            'state' => '',
        ]);

        $this->fillForm();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['cnpj'])) {
            $data['cnpj'] = preg_replace('/\D/', '', $data['cnpj']);
        }

        if (isset($data['cep'])) {
            $data['cep'] = preg_replace('/\D/', '', $data['cep']);
        }

        return $data;
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Salvo com sucesso!')
            ->body('As configurações foram salvas.');
    }

    protected function getRedirectUrl(): ?string
    {
        return null;
    }
}