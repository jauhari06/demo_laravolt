<?php

namespace App\Http\Livewire\Table;

use App\Http\Livewire\Filters\AuthorFilter;
use App\Http\Livewire\Filters\CreatedStartFilter;
use App\Http\Livewire\Filters\CreatedEndFilter;
use App\Http\Livewire\Filters\PublishedStartFilter;
use App\Http\Livewire\Filters\PublishedEndFilter;
use App\Http\Livewire\Filters\TopicFilter;
use App\Models\News;
use Laravolt\Suitable\Columns\DateTime;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Ui\TableView;

class NewsTable extends TableView
{

    public bool $showSearchbox = true;
    // public bool $autoRefresh = true;

    public int $searchDebounce = 500;

    protected int $defaultPerPage = 10;
    // protected array $perPageOptions = [5, 10, 20, 50];

    public function data()
    {
        return News::query()
            ->with(['author', 'topic'])
            ->whereLike(['title', 'slug'], $this->search) 
            ->autoSort($this->sortPayload());
            
            // ->autoFilter();
    }
    
    public function columns(): array
{
    return [
        Numbering::make('No'),

        Text::make('title', 'Judul')
            ->sortable()
            ->searchable(),

        Text::make('slug', 'Slug')
            ->sortable(),

        Text::make('topic.name', 'Topik')
            ->sortable('topic_id'), 
        Text::make('author.name', 'Penulis'),
        DateTime::make('published_at', 'Tanggal Publikasi')
            ->sortable(),

        RestfulButton::make('news', 'Action')->except('show'),
    ];
}

public function filters(): array
{
    return [
        new AuthorFilter(),
        new TopicFilter(),
        // new CreatedStartFilter(),
        // new CreatedEndFilter(),
        // new PublishedStartFilter(),
        // new PublishedEndFilter(),
    ];
}

}
