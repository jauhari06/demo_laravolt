<x-volt-app title="Daftar Topik">
    <h2 class="ui header">Manajemen Topik</h2>

    <div class="ui right aligned basic segment">
        <a href="{{ route('topics.create') }}" class="ui primary button">
            <i class="plus icon"></i> Tambah Topik
        </a>
    </div>

    <table class="ui celled table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Topik</th>
                <th>Slug</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topics as $topic)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $topic->name }}</td>
                    <td>{{ $topic->slug }}</td>
                    <td>{{ $topic->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('topics.edit', $topic) }}" class="ui icon button"><i class="edit icon"></i></a>
                        <form action="{{ route('topics.destroy', $topic) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ui red icon button" onclick="return confirm('Yakin ingin menghapus topik ini?')">
                                <i class="trash icon"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="center aligned">Belum ada topik.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $topics->links() }}
</x-volt-app>
