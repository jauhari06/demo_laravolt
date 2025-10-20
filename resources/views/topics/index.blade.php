@component('laravolt::layout.app', ['title' => 'Manajemen Berita'])
    <x-slot name="actions">
        <a href="{{ route('topics.create') }}" class="ui primary button">
            <i class="plus icon"></i> Tambah Topik
        </a>
    </x-slot>

    <div class="ui segment">

        @livewire(\App\Http\Livewire\Table\TopicTable::class)

    </div>
@endcomponent
