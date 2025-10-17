<x-volt-app title="Edit Topik">
    <h2 class="ui header">Edit Topik</h2>

    <form class="ui form" action="{{ route('topics.update', $topic) }}" method="POST">
        @csrf
        @method('PUT')
        {!! form()->text('name', 'Nama Topik')->required()->value($topic->name) !!}
        <div class="ui hidden divider"></div>
        {!! form()->submit('Perbarui Topik') !!}
        <a href="{{ route('topics.index') }}" class="ui button">Batal</a>
    </form>
</x-volt-app>
