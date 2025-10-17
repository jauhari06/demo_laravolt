<?php

namespace App\Http\Livewire\Statistic;

use Laravolt\Ui\Statistic;
use App\Models\News;

class TotalViews extends Statistic
{
    public string $label = 'Total Views';
    public ?string $icon = 'eye';

    public function value(): int|string
    {
        return number_format(News::sum('views_count'));
    }
}