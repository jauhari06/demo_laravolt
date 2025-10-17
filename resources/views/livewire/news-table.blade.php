<div>
    <table class="ui celled table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Slug</th>
                <th>Topik</th>
                <th>Penulis</th>
                <th>Tanggal Publikasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($news as $item)
                <tr>
                    <td>{{ $news->firstItem() + $loop->index }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->topic->name ?? '-' }}</td>
                    <td>{{ $item->author->name ?? 'Tidak diketahui' }}</td>
                    <td>{{ $item->published_at ?? '-' }}</td>
                    <td>
                        <a href="{{ route('news.edit', $item->id) }}" class="ui button">Edit</a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ui red button">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="center aligned">Tidak ada data berita.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>