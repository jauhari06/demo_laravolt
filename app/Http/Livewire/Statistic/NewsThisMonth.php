<?php

namespace App\Http\Livewire\Statistic;

use Laravolt\Ui\Statistic;
use App\Models\News;

class NewsThisMonth extends Statistic
{
    public string $label = 'Berita Bulan Ini';
    public ?string $icon = 'calendar';
    public ?string $color = 'violet';

    public function value(): int|string
    {
        return News::whereMonth('published_at', now()->month)
                    ->whereYear('published_at', now()->year)
                    ->count();
    }
}