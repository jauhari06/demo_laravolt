@component('laravolt::layout.app', ['title' => 'Edit Berita: ' . ($news->title ?? 'Loading...')])
    <x-slot name="actions">
        <a href="{{ route('news.index') }}" class="ui icon button">
            <i class="angle left icon"></i> Kembali
        </a>
    </x-slot>

    {!! form()->bind($news)->put(route('news.update', $news->id))->multipart() !!}
        
        {!! form()->text('title')->label('Judul Berita')->required() !!}
        {!! form()->text('slug')->label('Slug')->hint('Akan digunakan di URL')->required() !!}
        {!! form()->redactor('content')->label('Konten Berita')->required() !!} 
        {!! form()->select('topic_id', \App\Models\Topic::pluck('name', 'id'))
            ->label('Pilih Topik')->placeholder('Pilih salah satu topik')->required() !!}

        {!! form()->datepicker('published_at', null, 'd F Y H:i')->withTime()->label('Tanggal Publikasi') !!}

        {!! form()->uploader('image')->label('Masukkan Gambar')->extensions(['jpg', 'png'])->fileMaxSize(5) !!}

        @php
            $statusOptions = [
                'draft' => 'Simpan sebagai Draft',
                'pending' => 'Kirim untuk Review'
            ];
            
            if (auth()->user()->hasRole('Admin') && $news->status === 'published') {
                $statusOptions = [
                    'published' => 'Tetap Tayang',
                    'archived' => 'Arsipkan (Tarik dari peredaran)'
                ];
            }
        @endphp

{!! form()->select('status', $statusOptions)->label('Status Publikasi')->required() !!}
        
        {!! form()->action([
            form()->submit('Simpan Perubahan'),
            form()->link('Batal', route('news.index'))
        ]) !!}

    {!! form()->close() !!}
@endcomponent