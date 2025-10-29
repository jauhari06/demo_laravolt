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
use Laravolt\Suitable\Columns\Html; 
use Laravolt\Suitable\Columns\Raw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NewsTable extends TableView
{

    public bool $showSearchbox = true;

    public int $searchDebounce = 500;

    protected int $defaultPerPage = 10;

    public function data()
    {
        return News::query()
            ->with(['author', 'topic'])
            ->whereLike(['title', 'slug'], $this->search) 
            ->autoSort($this->sortPayload())
            ->autoFilter()
            ->paginate($this->perPage);
    }
public function columns(): array
{
    $columns = [
        Numbering::make('No'),
        Text::make('title', 'Judul')->sortable(),
        Text::make('author.name', 'Penulis'),
        Html::make(function ($news) {
            $colors = [
                'draft' => 'grey', 'pending' => 'yellow', 'published' => 'green',
                'rejected' => 'red', 'archived' => 'black',
            ];
            $color = $colors[$news->status] ?? 'grey';
            $statusText = \Illuminate\Support\Str::of($news->status)->replace('_', ' ')->title();
            $html = "<span class='ui label small {$color}'>{$statusText}</span>";
            if ($news->is_flagged) {
                $html .= '<br><span class="ui label red small" style="margin-top: 5px;"><i class="flag icon"></i>Flagged</span>';
            }
            return $html;
        }, 'Status'),
        DateTime::make('published_at', 'Tgl Publikasi')->sortable(),
    ];
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user->hasRole('contributor')) {
        $columns[] = RestfulButton::make('news')->only(['edit', 'delete']);
        $columns[] = Raw::make(function($news) {
            $buttons = '<div class="ui buttons mini">';
            if ($news->status === 'pending' && Gate::allows('approve', $news)) {
                $buttons .= '
                    <form action="'.route('news.approve', $news->id).'" method="POST" style="display:inline-block;">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="ui button green" title="Setujui">Setujui</button>
                    </form>';
            }
            if (Gate::allows('flag', $news)) {
                if ($news->is_flagged) {
                    $buttons .= '
                        <form action="'.route('news.unflag', $news->id).'" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="ui icon button yellow" title="Unflag"><i class="flag outline icon"></i></button>
                        </form>';
                } else {
                    $buttons .= '
                        <form action="'.route('news.flag', $news->id).'" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="ui icon button red" title="Flag"><i class="flag icon"></i></button>
                        </form>';
                }
            }
            $buttons .= '</div>';
            return $buttons;
        }, 'Aksi Kustom');
    }
    else {
        $columns[] = Raw::make(function($news) {
            if (Gate::allows('update', $news)) {
                return '<a href="'.route('news.edit', $news->id).'" class="ui icon button mini blue" title="Edit"><i class="edit icon"></i></a>';
            }
            return '';
        }, 'Aksi');
    }
    return $columns;
}
// public function columns(): array
//     {
//         // Langsung return array kolom, tanpa if/else peran
//         return [
//             Numbering::make('No'),
//             Text::make('title', 'Judul')->sortable(),
//             Text::make('author.name', 'Penulis'),
//             Html::make(function ($news) {
//                 // ... (logika status Anda sudah benar) ...
//                  $colors = [
//                      'draft' => 'grey', 'pending' => 'yellow', 'published' => 'green',
//                      'rejected' => 'red', 'archived' => 'black',
//                  ];
//                  $color = $colors[$news->status] ?? 'grey';
//                  $statusText = \Illuminate\Support\Str::of($news->status)->replace('_', ' ')->title();
//                  $html = "<span class='ui label small {$color}'>{$statusText}</span>";
//                  if ($news->is_flagged) {
//                      $html .= '<br><span class="ui label red small" style="margin-top: 5px;"><i class="flag icon"></i>Flagged</span>';
//                  }
//                  return $html;
//             }, 'Status'),
//             DateTime::make('published_at', 'Tgl Publikasi')->sortable(),

//             // 1. GUNAKAN RESTFULBUTTON BAWAAN
//             // Dia akan otomatis memanggil NewsPolicy@update dan NewsPolicy@delete.
//             // NewsPolicy Anda sudah benar, ini akan bekerja 100%.
//             RestfulButton::make('news')->only(['edit', 'delete']),

//             // 2. TOMBOL KUSTOM (SETUJUI & FLAG) TETAP DIPISAH
//             Raw::make(function($news) {
//                 $buttons = '<div class="ui buttons mini">';

//                 // Tombol Setujui: HARUS punya izin approve DAN statusnya 'pending'
//                 if ($news->status === 'pending' && Gate::allows('approve', $news)) {
//                     $buttons .= '
//                         <form action="'.route('news.approve', $news->id).'" method="POST" style="display:inline-block;">
//                             <input type="hidden" name="_token" value="'.csrf_token().'">
//                             <button type="submit" class="ui button green" title="Setujui">Setujui</button>
//                         </form>';
//                 }

//                 // Tombol Flag (hanya jika diizinkan)
//                 if (Gate::allows('flag', $news)) {
//                     if ($news->is_flagged) {
//                         $buttons .= '
//                             <form action="'.route('news.unflag', $news->id).'" method="POST" style="display:inline-block;">
//                                 <input type="hidden" name="_token" value="'.csrf_token().'">
//                                 <button type="submit" class="ui icon button yellow" title="Unflag"><i class="flag outline icon"></i></button>
//                             </form>';
//                     } else {
//                         $buttons .= '
//                             <form action="'.route('news.flag', $news->id).'" method="POST" style="display:inline-block;">
//                                 <input type="hidden" name="_token" value="'.csrf_token().'">
//                                 <button type="submit" class="ui icon button red" title="Flag"><i class="flag icon"></i></button>
//                             </form>';
//                     }
//                 }
//                 $buttons .= '</div>';
//                 // Kembalikan hanya jika ada tombol kustom, agar kolom tidak kosong
//                 return count(explode('<form', $buttons)) > 1 ? $buttons : '';
//             }, 'Aksi Kustom'),
//         ];
//     }
public function filters(): array
{
    return [
        new AuthorFilter(),
        new TopicFilter(),
        new CreatedStartFilter(),
        new CreatedEndFilter(),
        new PublishedStartFilter(),
        new PublishedEndFilter(),
    ];
}

}
