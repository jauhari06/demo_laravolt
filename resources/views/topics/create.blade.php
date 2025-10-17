<x-volt-app title="Tambah Topik">
    <h2 class="ui header">Tambah Topik Baru</h2>

    <form class="ui form" action="{{ route('topics.store') }}" method="POST">
        @csrf
        {!! form()->text('name', 'Nama Topik')->required() !!}
        <div class="ui hidden divider"></div>
        {!! form()->submit('Simpan Topik') !!}
        <a href="{{ route('topics.index') }}" class="ui button">Batal</a>
    </form>
</x-volt-app>
