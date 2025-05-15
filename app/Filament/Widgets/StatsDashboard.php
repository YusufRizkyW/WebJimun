<?php

namespace App\Filament\Widgets;

use App\Models\Antrian;
use App\Models\Jadwal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        // Hitung semua antrian (tanpa filter tanggal)
        $jumlahAntrian = Antrian::count();

        // Hitung semua jadwal imunisasi yang tercatat (tanpa filter tanggal)
        $jumlahJadwal = Jadwal::count();

        return [
            Stat::make('Total Antrian', number_format($jumlahAntrian))
                ->description('Antrian yang tercatat')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Total Jadwal Imunisasi', number_format($jumlahJadwal))
                ->description(
                    $jumlahJadwal > 0 
                        ? 'Jadwal tercatat' 
                        : 'Belum ada jadwal'
                )
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color($jumlahJadwal > 0 ? 'success' : 'danger'),
        ];
    }
}
