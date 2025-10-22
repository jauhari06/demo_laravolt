<?php
namespace App\Http\Livewire\Filters;
use App\Models\Topic;
use Laravolt\Ui\Filters\DropdownFilter;
class TopicFilter extends DropdownFilter
{
    // protected bool $manual = true;
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
}