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

    public function render(): string
    {
        $key = $this->key();

        return form()->datepicker($key)
            ->label($this->label)
            ->placeholder($this->label)
            ->removeClass('clearable')
            ->attributes(['wire:model.live' => "filters.$key"]);
    }
}