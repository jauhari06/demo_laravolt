<?php

namespace App\Http\Livewire\Table;

use Laravolt\Ui\TableView;
use App\Models\Topic;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\Columns\RestfulButton;

class TopicTable extends TableView
{
    public bool $showSearchbox = true;
    public int $searchDebounce = 500;

    protected int $defaultPerPage = 10;
    protected array $perPageOptions = [5, 10, 20, 50];

    public function data()
    {
        return Topic::query()
            ->whereLike(['name', 'slug'], $this->search)
            ->autoSort($this->sortPayload())
            ->paginate();
    }

    public function columns(): array
{
    return [
        Numbering::make('No'),

        Text::make('name', 'Nama Topik')
            ->sortable()
            ->searchable(),

        Text::make('slug', 'Slug')
            ->sortable(),

        RestfulButton::make('topics', 'Action')->except('show'),
    ];
}
}
