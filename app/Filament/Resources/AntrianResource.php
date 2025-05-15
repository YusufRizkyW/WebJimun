<?php

namespace App\Filament\Resources;

use App\Models\Riwayat;
use App\Models\Antrian;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\AntrianResource\Pages;

class AntrianResource extends Resource
{
    protected static ?string $model = Antrian::class;
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nik')
                ->label('Nomer Induk Kependudukan / NIK')
                ->required()
                ->maxLength(16)
                ->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('nama')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),
            Forms\Components\DatePicker::make('tanggal_lahir')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->label('Nomer Induk Kependudukan / NIK')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')->label('Nama Pasien')->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')->date()->sortable(),
                Tables\Columns\TextColumn::make('nomor_antrian')->label('No. Antrian')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('sudahHadir')
                    ->label('Sudah Hadir')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->form([
                        Forms\Components\FileUpload::make('foto_pemeriksaan')
                            ->label('Upload Bukti Pemeriksaan')
                            ->image()
                            ->directory('riwayat-foto')
                            ->visibility('public')
                            ->required(),
                    ])
                    ->action(function (Antrian $record, array $data) {
                        Riwayat::create([
                            'nik' => $record->nik,
                            'nama' => $record->nama,
                            'tanggal_lahir' => $record->tanggal_lahir,
                            'nomor_antrian' => $record->nomor_antrian,
                            'hadir_pada' => now(),
                            'foto_pemeriksaan' => $data['foto_pemeriksaan'],
                        ]);

                        $record->delete();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Sudah Hadir')
                    ->modalSubheading('Isi bukti & tandai pasien sudah hadir'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAntrians::route('/'),
            'create' => Pages\CreateAntrian::route('/create'),
            'edit' => Pages\EditAntrian::route('/{record}/edit'),
        ];
    }
}
