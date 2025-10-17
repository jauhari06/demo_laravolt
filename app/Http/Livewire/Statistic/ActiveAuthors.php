<?php

namespace App\Http\Livewire\Statistic;

use Laravolt\Ui\Statistic;
use App\Models\News;

class ActiveAuthors extends Statistic
{
    public string $label = 'Penulis Aktif';
    public ?string $icon = 'users';
    public ?string $color = 'orange';

    public function value(): int|string
    {
        return News::distinct('author_id')->count('author_id');
    }
}