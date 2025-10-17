@component('laravolt::layout.app', ['title' => 'Edit Berita: ' . ($news->title ?? 'Loading...')])
    <x-slot name="actions">
        <a href="{{ route('news.index') }}" class="ui icon button">
            <i class="angle left icon"></i> Kembali
        </a>
    </x-slot>
    
    {!! form()->open()->put()->multipart()->action(route('news.update', $news))->model($news) !!}

        @include('news._form')
    {!! form()->close() !!}
@endcomponent

