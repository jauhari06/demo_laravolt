@component('laravolt::layout.app', ['title' => 'Tambah Berita Baru'])
    <x-slot name="actions">
        <a href="{{ route('news.index') }}" class="ui icon button">
            <i class="angle left icon"></i> Kembali
        </a>
    </x-slot>
    
    {!! form()->open()->post()->multipart()->action(route('news.store')) !!}

        @include('news._form')
    {!! form()->close() !!}
@endcomponent
