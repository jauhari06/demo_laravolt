<?php
namespace App\Http\Livewire\Filters;

use Laravolt\Ui\Filters\DateFilter;
use Carbon\Carbon;

class CreatedStartFilter extends DateFilter
{
    protected string $label = 'dibuat setelah';

    public function apply($data, $value)
    {
        if ($value) {
            $data->where('created_at', '>=', Carbon::parse($value)->startOfDay());
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