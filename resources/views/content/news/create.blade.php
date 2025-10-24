@component('laravolt::layout.app', ['title' => 'Tambah Berita Baru'])
    <x-slot name="actions">
        <a href="{{ route('news.index') }}" class="ui icon button">
            <i class="angle left icon"></i> Kembali
        </a>
    </x-slot>

    {!! form()->post(route('news.store'))->multipart() !!}
    {!! form()->hidden('status', 'draft') !!}
        <div class="ui segment">
            {!! form()->text('title')
                ->label('Judul Berita')
                ->required() !!}

            {!! form()->text('slug')
                ->hint('Akan digunakan di URL, hanya boleh huruf, angka, dan dash')
                ->label('Slug')
                ->required() !!}

            {!! form()->redactor('content') 
                ->label('Konten Berita')
                ->required() !!}
            

            {!! form()->select('topic_id', \App\Models\Topic::pluck('name', 'id'))
                ->label('Pilih Topik')
                ->placeholder('Pilih salah satu topik')
                ->required() !!}

            {!! form()->datepicker('published_at', null, 'd F Y H:i')
                ->withTime()
                ->label('Tanggal Publikasi') !!}

            {!! form()->uploader('image')
                ->label('Masukkan Gambar')
                ->extensions(['jpg', 'png'])
                ->fileMaxSize(5) !!}

            {!! form()->action([
                form()->submit('Simpan Berita'),
                form()->link('Batal', route('news.index'))
            ]) !!}
        </div>

    {!! form()->close() !!}
@endcomponent