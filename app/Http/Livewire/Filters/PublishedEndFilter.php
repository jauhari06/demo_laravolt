<?php
namespace App\Http\Livewire\Filters;

use Laravolt\Ui\Filters\DateFilter;
use Carbon\Carbon;
class PublishedEndFilter extends DateFilter
{
    protected string $label = 'Publikasi Sebelum';
    
    public function apply($data, $value)
    {
        if ($value) {
            $data->where('published_at', '<=', Carbon::parse($value)->endOfDay());
        }
        return $data;
    }
}