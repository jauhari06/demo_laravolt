@component('laravolt::layout.app', ['title' => 'Manajemen Berita'])
    <x-slot name="actions">
        <a href="{{ route('news.create') }}" class="ui primary button">
            <i class="plus icon"></i> Tambah Berita
        </a>
    </x-slot>

    <div class="ui segment">
        @livewire(\App\Http\Livewire\Table\NewsTable::class)
    </div>
@endcomponent
