<?php

namespace App\Filament\Exports;

use App\Models\Datawakif;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class DatawakifExporter extends Exporter
{
    protected static ?string $model = Datawakif::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nama'),
            ExportColumn::make('alamat'),
            ExportColumn::make('notelpon'),
            ExportColumn::make('tglwakaf'),
            ExportColumn::make('wakafpembangunan'),
            ExportColumn::make('wakafproduktif'),
            ExportColumn::make('donasipendidikan'),
            ExportColumn::make('banktransfer'),
            ExportColumn::make('catatan'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your datawakif export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
