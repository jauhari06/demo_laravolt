<?php

namespace App\Http\Livewire\Chart;

use Laravolt\Charts\Line;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewsMonthChart extends Line
{
    public string $title = 'Statistik Berita Bulan Ini';

    protected int $height = 350;

     /**
     * Jika ingin menampilkan versi kecil tanpa sumbu dan label, ubah ke true
     * @link https://apexcharts.com/docs/options/chart/sparkline/
     */
    protected bool $sparkline = false;

    public function series(): array
    {
        
        $newsData = News::select(
                DB::raw('DATE(published_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->whereMonth('published_at', now()->month)
            ->whereYear('published_at', now()->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $seriesData = [];
        foreach ($newsData as $row) {
            $label = Carbon::parse($row->date)->translatedFormat('j M');
            $seriesData[$label] = (int) $row->total;
        }

        return [
            'Jumlah Berita' => $seriesData,
        ];
    }
}