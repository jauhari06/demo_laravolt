<?php

namespace App\Http\Livewire\Table;

use Laravolt\Ui\TableView;
use App\Models\News;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\DateTime;

class NewsTable extends TableView
{
    // private const DEFAULT_PER_PAGE = 10;

    public bool $showSearchbox = true;
    public int $searchDebounce = 500;

    protected int $defaultPerPage = 10;
    // protected array $perPageOptions = [5, 10, 20, 50];

    public function data()
    {
        return News::query()
            ->with(['author', 'topic'])
            ->whereLike(['title', 'slug'], $this->search) 
            ->latest('published_at')
            ->paginate();
    }

    public function columns(): array
    {
        return [
            Numbering::make('No'),
            Text::make('title', 'Judul')->searchable(),
            Text::make('slug', 'Slug'),
            Text::make('topic.name', 'Topik'),
            Text::make('author.name', 'Penulis'),
            DateTime::make('published_at', 'Tanggal Publikasi')->sortable(),
            RestfulButton::make('news','	Action')->except('show'),
        ];
    }
}
