<?php

namespace App\Http\Livewire\Table;

use Laravolt\Ui\TableView;
use App\Models\ActivityLog;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\Text;

class ActivityTable extends TableView
{
    public bool $showSearchbox = true;
    public int $searchDebounce = 400;

    protected int $defaultPerPage = 15;
    // protected array $perPageOptions = [10, 15, 30, 50];

    public function data()
    {
        return ActivityLog::with('user')
            ->whereLike(['action', 'model_type'], $this->search)
            ->latest('created_at')
            ->paginate();
    }

    public function columns(): array
    {
        return [
            Numbering::make('No'),
            Text::make('user.name', 'Pengguna'),
            Text::make('action', 'Aksi'),
            Text::make('created_at', 'Waktu'),
        ];
    }
}
