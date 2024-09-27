<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Datawakif;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Actions\DownloadAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\DatawakifResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DatawakifResource\RelationManagers;
use App\Filament\Resources\DatawakifResource\Pages\ListDatawakifs;
use App\Filament\Resources\DatawakifResource\Pages\CreateDatawakif;
use Dflydev\DotAccessData\Data;

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
                    ->currencyMask(thousandSeparator: ',',decimalSeparator: '.',precision: 2)
                    ->numeric()
                    ->label('Wakaf Pembangunan'),
                Forms\Components\TextInput::make('wakafproduktif')
                    ->currencyMask(thousandSeparator: ',',decimalSeparator: '.',precision: 2)
                    ->numeric()
                    ->label('Wakaf Produktif'),
                Forms\Components\TextInput::make('donasipendidikan')
                    ->currencyMask(thousandSeparator: ',',decimalSeparator: '.',precision: 2)
                    ->numeric()
                    ->label('Donasi Pendidikan'),
                Forms\Components\Select::make('banktransfer')
                    ->required()
                    ->label('Bank Transfer')
                    ->options([
                        'BRKS' => 'BANK RIAU KEPRI SYARIAH',
                        'BSI' => 'BANK SYARIAH INDONESIA',
                    ]),
                Forms\Components\FileUpload::make('image')
                    ->image()
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('wakafpembangunan')
                    ->label('Wakaf Pembangunan')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wakafproduktif')
                    ->label('Wakaf Produktif')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('donasipendidikan')
                    ->label('Donasi Pendidikan')
                    ->prefix('Rp. ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('banktransfer')
                    ->label('Bank Transfer')
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DownloadAction::make('Kwitansi')
                ->url(fn(Datawakif $record) => route('pdf', $record->id))
                ->openUrlInNewTab(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
