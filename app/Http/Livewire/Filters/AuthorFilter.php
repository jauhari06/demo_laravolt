<?php
namespace App\Http\Livewire\Filters;
use App\Models\User;
use Laravolt\Ui\Filters\DropdownFilter;
class AuthorFilter extends DropdownFilter
{
    // protected bool $manual = true;
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
}