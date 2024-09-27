<?php

namespace App\Filament\Resources\DatawakifResource\Pages;

use App\Filament\Resources\DatawakifResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDatawakifs extends ListRecords
{
    protected static string $resource = DatawakifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ButtonAction::make('Laporan')
            ->url(fn()=> route('laporan'))->openUrlInNewTab(),
        ];
    }
}
