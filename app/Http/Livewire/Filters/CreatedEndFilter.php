<?php
namespace App\Http\Livewire\Filters;

use Laravolt\Ui\Filters\DateFilter;
use Carbon\Carbon;

class CreatedEndFilter extends DateFilter
{
    protected string $label = 'Dibuat Sebelum';

    public function apply($data, $value)
    {
        if ($value) {
            $data->where('created_at', '<=', Carbon::parse($value)->endOfDay());
        }
        return $data;
    }
}