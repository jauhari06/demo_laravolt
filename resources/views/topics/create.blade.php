@component('laravolt::layout.app', ['title' => 'Tambah Topik Baru'])
<x-slot name="actions">
    <a href="{{ route('topics.index') }}" class="ui icon button">
        <i class="angle left icon"></i> Kembali
    </a>
</x-slot>
    
    {!! form()->open()->post()->multipart()->action(route('topics.store')) !!}
    
        @include('topics.form')

    {!! form()->close() !!}

@endcomponent