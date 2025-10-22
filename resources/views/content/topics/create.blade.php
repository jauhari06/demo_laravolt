@component('laravolt::layout.app', ['title' => 'Tambah Topik Baru'])
<x-slot name="actions">
    <a href="{{ route('topics.index') }}" class="ui icon button">
        <i class="angle left icon"></i> Kembali
    </a>
</x-slot>
{!! form()->post(route('topics.store')) !!}
    
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