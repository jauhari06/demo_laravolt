<div class="ui segment">
    
    <p>Judul Berita</p>
    {!! form()->text('title', 'Judul Berita')->required() !!} 
    
    <p>Slug</p>
    {!! form()->text('slug', 'Slug')->hint('Akan digunakan di URL, hanya boleh huruf, angka, dan dash')->required() !!}
    
    <p>Konten Berita</p>
    {!! form()->textarea('content', 'Konten Berita')->rows(15)->required()->value($news->content ?? '') !!}


    <p>Topik Berita</p>
    {!! form()
        ->select('topic_id', \App\Models\Topic::pluck('name', 'id'))
        ->label('Pilih Topik')
        ->placeholder('Pilih salah satu topik')
        ->required()
        ->value(old('topic_id', $news->topic_id ?? '')) !!}
    
    <div class="field">
        <label for="published_at">Tanggal Publikasi</label>
        <input type="datetime-local" name="published_at" id="published_at" 
               value="{{ old('published_at', isset($news) ? $news->published_at->format('Y-m-d\TH:i') : '') }}" 
               required>
        <small class="hint">Tanggal akan disimpan dalam format YYYY-MM-DD HH:MM:SS</small>
    </div>

    {!! form()->uploader('image')
    ->extensions(['jpg', 'png'])
    ->fileMaxSize(5)
    ->hint('Hanya file dengan format JPG atau PNG yang diperbolehkan.') !!}

    <div class="ui hidden divider"></div>
    <div class="ui right aligned basic segment">
        <a href="{{ route('news.index') }}" class="ui button">Batal</a>
        {!! form()->submit('Simpan Berita') !!}
    </div>
</div>

