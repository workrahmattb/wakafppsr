<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Datawakif;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Dflydev\DotAccessData\Data;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\DownloadAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\DatawakifExporter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\Summarizers\Average;
use App\Filament\Resources\DatawakifResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DatawakifResource\RelationManagers;
use App\Filament\Resources\DatawakifResource\Pages\ListDatawakifs;
use App\Filament\Resources\DatawakifResource\Pages\CreateDatawakif;
use Filament\Tables\Actions\ExportBulkAction;

class DatawakifResource extends Resource
{
    protected static ?string $model = Datawakif::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->label('Nama')
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat')
                    ->maxLength(255)
                    ->label('Alamat'),
                Forms\Components\TextInput::make('notelpon')
                    ->tel()
                    ->required()
                    ->label('Nomor Telpon')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tglwakaf')
                    ->label('Tanggal Wakaf')
                    ->required(),
                Forms\Components\TextInput::make('wakafpembangunan')
                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                    ->numeric()
                    ->label('Wakaf Pembangunan'),
                Forms\Components\TextInput::make('wakafproduktif')
                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                    ->numeric()
                    ->label('Wakaf Produktif'),
                Forms\Components\TextInput::make('donasipendidikan')
                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                    ->numeric()
                    ->label('Donasi Pendidikan'),
                Forms\Components\Select::make('banktransfer')
                    ->required()
                    ->label('Bank Transfer')
                    ->options([
                        'BRKS' => 'BANK RIAU KEPRI SYARIAH',
                        'BSI' => 'BANK SYARIAH INDONESIA',
                        'CASH' => 'CASH',
                    ]),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->enableDownload()
                    ->enableOpen()
                    ->label('Bukti Transfer'),
                Forms\Components\TextInput::make('catatan')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('notelpon')
                    ->label('Nomor Telpon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tglwakaf')
                    ->label('Tanggal Wakaf')
                    ->date()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('wakafpembangunan')
                    ->label('Wakaf Pembangunan')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->summarize(Sum::make()->prefix('Rp. ')->label('Wakaf Pembangunan'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('wakafproduktif')
                    ->label('Wakaf Produktif')
                    ->prefix('Rp. ')
                    ->summarize(Sum::make()->prefix('Rp. ')->label('Wakaf Produktif'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('donasipendidikan')
                    ->label('Donasi Pendidikan')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->summarize(Sum::make()->prefix('Rp. ')->label('Donasi Pendidikan'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('banktransfer')
                    ->label('Bank Transfer')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Bukti Transfer'),
                Tables\Columns\TextColumn::make('catatan')
                    ->label('Catatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                SelectFilter::make('banktransfer')
                    ->label("Bank Transfer")
                    ->options([
                        'BRKS' => 'BANK RIAU KEPRI SYARIAH',
                        'BSI' => 'BANK SYARIAH INDONESIA',
                        'CASH' => 'CASH',
                    ]),

                Filter::make('tglwakaf')
                    ->form([
                        DatePicker::make('tglwakaf_from'),
                        DatePicker::make('tglwakaf_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['tglwakaf_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tglwakaf', '>=', $date),
                            )
                            ->when(
                                $data['tglwakaf_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tglwakaf', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DownloadAction::make('Kwitansi')
                    ->url(fn(Datawakif $record) => route('pdf', $record->id))
                    ->openUrlInNewTab(),

            ])
            ->headerActions([
                ExportAction::make()->exporter(DatawakifExporter::class),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make('export')->exporter(DatawakifExporter::class),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDatawakifs::route('/'),
            'create' => Pages\CreateDatawakif::route('/create'),

        ];
    }
}
