<?php

namespace App\Filament\Widgets;

use App\Models\Datawakif;
use Filament\Widgets\StatsOverviewWidget\Card;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DatawakifSum extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Wakaf Pembangunan', 'Rp ' . number_format(Datawakif::sum('wakafpembangunan'))),
            Card::make('Wakaf Produktif', 'Rp ' . number_format(Datawakif::sum('wakafproduktif'))),
            Card::make('Donasi Pendidikan', 'Rp ' . number_format(Datawakif::sum('donasipendidikan'))),
        ];
    }
}
