<?php

namespace App\Http\Livewire\Chart;

use Livewire\Component;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewsThisMonthChart extends Component
{
    public $labels = [];
    public $data = [];

    public function mount()
    {
        $newsData = News::select(
                DB::raw('DATE(published_at) as date'),
                DB::raw('count(*) as total')
            )
            ->whereMonth('published_at', now()->month)
            ->whereYear('published_at', now()->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $this->labels = $newsData->map(fn($item) => Carbon::parse($item->date)->translatedFormat('j M'))->toArray();
        $this->data = $newsData->pluck('total')->toArray();
    }

    public function render()
    {
        return view('livewire.chart-news-month');
    }
}
