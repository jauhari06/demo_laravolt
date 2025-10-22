<?php
namespace App\Http\Livewire\Filters;

use Laravolt\Ui\Filters\DateFilter;
use Carbon\Carbon;

class CreatedStartFilter extends DateFilter
{
    protected string $label = 'Waktu Pembuatan';

    public function apply($data, $value)
    {
        if ($value) {
            $data->where('created_at', '>=', Carbon::parse($value)->startOfDay());
        }
        return $data;
    }
}