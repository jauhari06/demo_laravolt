
<div class="ui segment">
    <div class="p-6">
        {!! form()->text('name')->label('Nama Topik')->required() !!}
        
        {!! form()->text('slug')
            ->label('Slug')
            ->required()
            ->hint('Slug digunakan di URL. Jika dikosongkan, akan dibuat otomatis dari Nama Topik.')
        !!}
    </div>

    <div class="ui divider"></div>

    <div class="ui right aligned basic segment">
        {!! form()->link('Batal', route('topics.index'))->class('ui button basic') !!}
        {!! form()->submit('Simpan')->class('ui primary button ml-2') !!}
    </div>
</div>
