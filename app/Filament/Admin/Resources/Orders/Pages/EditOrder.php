<?php

namespace App\Filament\Admin\Resources\Orders\Pages;

use App\Filament\Admin\Resources\Orders\OrderResource;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function afterSave(): void
    {
        $total = $this->record->items()->sum('subtotal');
        
        $this->record->update([
            'total_amount' => round($total, 2)
        ]);
    }
}