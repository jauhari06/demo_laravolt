<?php
namespace App\Http\Livewire\Filters;
use App\Models\User;
use Laravolt\Ui\Filters\DropdownFilter;
class AuthorFilter extends DropdownFilter
{
    protected string $label = 'Penulis';
    public function apply($data, $value)
    {
        if ($value) { 
            $data->where('author_id', $value);
        }
        return $data;

    }
    public function options(): array
    {
        return User::query()
            ->pluck('name', 'id')
            ->prepend('Semua Penulis', '')
            ->toArray();
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