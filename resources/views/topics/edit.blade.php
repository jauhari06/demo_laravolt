@component('laravolt::layout.app', ['title' => 'Edit Topik'])
    <x-slot name="actions">
        <x-laravolt::button as="a" href="{{ route('topics.index') }}" icon="left arrow" class="basic">
            Kembali
        </x-laravolt::button>
    </x-slot>


    {!! form()->open()->put()->route('topics.update', $topic) !!}

        @include('topics.form', ['topic' => $topic])

    {!! form()->close() !!}
    @endcomponent