<?php

namespace App\Filament\Resources\DatawakifResource\Pages;

use App\Filament\Resources\DatawakifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatawakif extends EditRecord
{
    protected static string $resource = DatawakifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
