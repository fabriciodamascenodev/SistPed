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
        // Sempre usa o registro ID=1 (ou cria vazio se não existir)
        $this->record = CompanySetting::find(1) ?? new CompanySetting(['id' => 1]);

        $this->fillForm();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Limpa CNPJ e CEP antes de salvar
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
            ->title('Configurações salvas')
            ->body('As configurações da empresa foram salvas com sucesso.');
    }

    protected function getRedirectUrl(): ?string
    {
        return null; // Fica na mesma página
    }
}