<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;
use Livewire\WithPagination;

class NewsTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'semantic';
    public function render()
    
    {
        $news = News::with(['author', 'topic'])->paginate(10);

        return view('livewire.news-table', compact('news'));
    }
}