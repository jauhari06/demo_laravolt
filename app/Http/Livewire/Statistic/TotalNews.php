<?php

namespace App\Http\Livewire\Statistic;

use Laravolt\Ui\Statistic;
use App\Models\News;


class TotalNews extends Statistic
{
    public string $label = 'Total Berita';
    public ?string $icon = 'newspaper';

    public ?string $color = 'blue';

    public function value(): int|string
    {
        return News::count();
    }
}