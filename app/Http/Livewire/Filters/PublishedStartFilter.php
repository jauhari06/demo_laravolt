<?php
namespace App\Http\Livewire\Filters;

use Laravolt\Ui\Filters\DateFilter;
use Carbon\Carbon;
class PublishedStartFilter extends DateFilter
{
    protected string $label = 'Publikasi Setelah';
    
    public function apply($data, $value)
    {
        if ($value) {
            $data->where('published_at', '>=', Carbon::parse($value)->startOfDay());
        }
        return $data;
    }
}