@component('laravolt::layout.app', ['title' => 'Edit Topik'])
    <x-slot name="actions">
        <x-laravolt::button as="a" href="{{ route('topics.index') }}" icon="left arrow" class="basic">
            Kembali
        </x-laravolt::button>
    </x-slot>

    {!! form()->bind($topic)->put(route('topics.update', $topic->id)) !!}

        {!! form()->text('name')->label('Nama Topik')->required() !!}

        {!! form()->text('slug')
        ->label('Slug')
        ->required()
        ->hint('Slug digunakan di URL. Jika dikosongkan, akan dibuat otomatis dari Nama Topik.')
        !!}
        {!! form()->action([
            form()->submit('Simpan Topik'),
            form()->link('Batal', route('topics.index'))
        ]) !!}
{!! form()->close() !!}
@endcomponent