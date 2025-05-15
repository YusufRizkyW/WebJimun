<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatResource\Pages;
use App\Models\Riwayat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RiwayatResource extends Resource
{
    protected static ?string $model = Riwayat::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nik')
                    ->label('Nomer Induk Kependudukan')
                    ->required()
                    ->maxLength(16)
                    ->lazy()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->lazy()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),

                Forms\Components\TextInput::make('nomor_antrian')
                    ->required()
                    ->numeric(),

                Forms\Components\DateTimePicker::make('hadir_pada'),

                // ✅ Upload gambar
                Forms\Components\FileUpload::make('foto_pemeriksaan')
                ->label('Foto Pemeriksaan')
                ->disk('public') // WAJIB!
                ->directory('riwayat-foto') // WAJIB!
                ->visibility('public') // ‼️ INI YANG BELUM ADA
                ->image()
                ->imagePreviewHeight('100')
                ->maxSize(2048)
                ->columnSpanFull()
                ->lazy(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')->date()->sortable(),
                Tables\Columns\TextColumn::make('nomor_antrian')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('hadir_pada')->dateTime()->sortable(),

                // ✅ Tampilkan gambar
                Tables\Columns\ImageColumn::make('foto_pemeriksaan')
                    ->label('Foto Pemeriksaan')
                    ->disk('public') 
                    ->circular()
                    ->height(40),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayats::route('/'),
            'create' => Pages\CreateRiwayat::route('/create'),
            'edit' => Pages\EditRiwayat::route('/{record}/edit'),
        ];
    }
}
