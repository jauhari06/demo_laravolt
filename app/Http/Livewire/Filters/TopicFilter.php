<?php
namespace App\Http\Livewire\Filters;
use App\Models\Topic;
use Laravolt\Ui\Filters\DropdownFilter;
class TopicFilter extends DropdownFilter
{
    protected string $label = 'Topik';
    public function apply($data, $value)
    {
        if ($value) { 
            $data->where('topic_id', $value);
        }
        return $data;
    
    }
    public function options(): array
    {
        return Topic::query()->pluck('name', 'id')
        ->prepend('Semua Topik', '')->toArray();
    }

    public function render(): string
    {
        $key = $this->key();
        $field=form()->dropdown($key, $this->options());
        
        if ($this->placeholder) {
            $field->placeholder($this->placeholder);
        }

        return $field
        ->label($this->label." - $key")
        ->removeClass('clearable') 
        ->attributes(['wire:model.live' => "filters.$key"]);
    }
}